import React, { useState, useEffect } from 'react';
import { getBackupImageUrls, getImageUrl } from '../api/api.js';
// import hybridImageService from '../services/localImageService.js'; // DEPRECATED - now using direct folder storage

/**
 * FallbackImage Component - Hiển thị ảnh với direct folder storage
 * Simplified from MinIO fallback system
 */
const FallbackImage = ({ 
  filename, 
  alt = "Image", 
  className = "", 
  style = {},
  placeholder = null,
  onLoadSuccess = null,
  onLoadError = null,
  showLoadingIndicator = true
}) => {
  const [currentSrc, setCurrentSrc] = useState('');
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(false);
  const [triedUrls, setTriedUrls] = useState([]);

  useEffect(() => {
    if (!filename) {
      setLoading(false);
      setError(true);
      return;
    }

    // Reset state khi filename thay đổi
    setLoading(true);
    setError(false);
    setTriedUrls([]);

    loadImageWithFallback();
  }, [filename]);

  const loadImageWithFallback = async () => {
    try {
      console.log(`🔍 FallbackImage: Loading image ${filename}`);
      
      // Sử dụng getImageUrl để lấy image src với API backend
      const src = await getImageUrl(filename);
      
      if (src) {
        console.log(`✅ FallbackImage: Successfully loaded from API: ${filename}`);
        console.log(`📏 FallbackImage: Base64 length: ${src.length} chars`);
        setCurrentSrc(src);
        setLoading(false);
        setError(false);
        
        if (onLoadSuccess) {
          onLoadSuccess(src, 0);
        }
      } else {
        console.warn(`❌ FallbackImage: No image source found from API for ${filename}`);
        throw new Error('No image source found from API');
      }
    } catch (error) {
      console.error(`❌ FallbackImage: API failed for ${filename}:`, error);
      
      // For local storage system, no backup URLs available
      // Display error state directly
      console.error(`Failed to load image from primary source: ${filename}`);
      setLoading(false);
      setError(true);
      if (onLoadError) {
        onLoadError(new Error(`Failed to load image: ${filename}`));
      }
    }
  };

  const tryLoadImage = (urls, index) => {
    if (index >= urls.length) {
      // Đã thử hết tất cả URLs
      console.error(`Failed to load image from all URLs: ${filename}`);
      setLoading(false);
      setError(true);
      if (onLoadError) {
        onLoadError(new Error(`Failed to load image: ${filename}`));
      }
      return;
    }

    const url = urls[index];
    console.log(`Trying URL ${index + 1}/${urls.length}: ${url}`);

    // Tạo new Image để test load
    const img = new Image();
    img.crossOrigin = 'anonymous'; // Cho phép CORS nếu cần

    img.onload = () => {
      console.log(`Successfully loaded from: ${url}`);
      setCurrentSrc(url);
      setLoading(false);
      setError(false);
      setTriedUrls(prev => [...prev, { url, status: 'success' }]);
      
      if (onLoadSuccess) {
        onLoadSuccess(url, index);
      }
    };

    img.onerror = () => {
      console.warn(`Failed to load from: ${url}`);
      setTriedUrls(prev => [...prev, { url, status: 'failed' }]);
      
      // Thử URL tiếp theo sau 500ms delay
      setTimeout(() => {
        tryLoadImage(urls, index + 1);
      }, 500);
    };

    // Bắt đầu load
    img.src = url;
  };

  if (loading && showLoadingIndicator) {
    return (
      <div className={`fallback-image-loading ${className}`} style={style}>
        {placeholder || (
          <div style={{ 
            display: 'flex', 
            alignItems: 'center', 
            justifyContent: 'center',
            minHeight: '50px',
            backgroundColor: '#f5f5f5',
            color: '#666',
            fontSize: '12px'
          }}>
            📷 Loading...
          </div>
        )}
      </div>
    );
  }

  if (error) {
    return (
      <div className={`fallback-image-error ${className}`} style={style}>
        {placeholder || (
          <div style={{ 
            display: 'flex', 
            alignItems: 'center', 
            justifyContent: 'center',
            minHeight: '50px',
            backgroundColor: '#f8f8f8',
            color: '#999',
            fontSize: '12px',
            border: '1px dashed #ddd'
          }}>
            Không tải được ảnh
          </div>
        )}
      </div>
    );
  }

  return (
    <img 
      src={currentSrc}
      alt={alt}
      className={className}
      style={style}
      onError={() => {
        console.error(`Image load error after successful test: ${currentSrc}`);
        setError(true);
      }}
    />
  );
};

export default FallbackImage;

/**
 * Hook để sử dụng fallback image loading logic
 */
export const useFallbackImage = (filename) => {
  const [imageState, setImageState] = useState({
    src: '',
    loading: true,
    error: false,
    triedUrls: []
  });

  useEffect(() => {
    if (!filename) {
      setImageState({
        src: '',
        loading: false,
        error: true,
        triedUrls: []
      });
      return;
    }

    setImageState(prev => ({
      ...prev,
      loading: true,
      error: false,
      triedUrls: []
    }));

    const loadImage = async () => {
      try {
        // Sử dụng getImageUrl API trước
        const src = await getImageUrl(filename);
        
        if (src) {
          setImageState(prev => ({
            ...prev,
            src,
            loading: false,
            error: false,
            triedUrls: [...prev.triedUrls, { url: src, status: 'success' }]
          }));
          return;
        }
        
        throw new Error('API service failed');
      } catch (error) {
        // Fallback to backup URLs method
        const urls = filename.startsWith('http://') || filename.startsWith('https://') 
          ? [filename] 
          : getBackupImageUrls(filename);

        const tryLoad = async (urlList, index = 0) => {
          if (index >= urlList.length) {
            setImageState(prev => ({
              ...prev,
              loading: false,
              error: true
            }));
            return;
          }

          const url = urlList[index];
          
          try {
            const img = new Image();
            img.crossOrigin = 'anonymous';
            
            await new Promise((resolve, reject) => {
              img.onload = resolve;
              img.onerror = reject;
              img.src = url;
            });

            setImageState(prev => ({
              ...prev,
              src: url,
              loading: false,
              error: false,
              triedUrls: [...prev.triedUrls, { url, status: 'success' }]
            }));

          } catch (error) {
            setImageState(prev => ({
              ...prev,
              triedUrls: [...prev.triedUrls, { url, status: 'failed' }]
            }));
            
            setTimeout(() => tryLoad(urlList, index + 1), 500);
          }
        };

        tryLoad(urls);
      }
    };

    loadImage();
  }, [filename]);

  return imageState;
};
