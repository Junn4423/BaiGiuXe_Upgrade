import React from 'react';
import { useToast } from '../components/Toast';

// Component for testing Toast system
const ToastTester = () => {
  const { showToast, ToastContainer } = useToast();

  const testSingleToast = () => {
    showToast('Single toast test', 'success');
  };

  const testMultipleToasts = () => {
    showToast('First toast', 'success');
    showToast('Second toast', 'info');
    showToast('Third toast', 'warning');
    showToast('Fourth toast', 'error');
    showToast('Fifth toast', 'success');
  };

  const testDifferentTypes = () => {
    setTimeout(() => showToast('Success message', 'success'), 100);
    setTimeout(() => showToast('Info message', 'info'), 200);
    setTimeout(() => showToast('Warning message', 'warning'), 300);
    setTimeout(() => showToast('Error message', 'error'), 400);
  };

  const testLongMessage = () => {
    showToast('This is a very long message to test how the toast handles longer text content and whether it wraps properly', 'info');
  };

  const testRapidFire = () => {
    for (let i = 1; i <= 10; i++) {
      showToast(`Rapid fire toast #${i}`, i % 2 === 0 ? 'success' : 'info');
    }
  };

  return (
    <div style={{ 
      padding: '20px', 
      fontFamily: 'Arial, sans-serif',
      maxWidth: '600px',
      margin: '0 auto'
    }}>
      <h2>Toast System Tester</h2>
      <p>Click the buttons below to test the Toast notification system:</p>
      
      <div style={{ 
        display: 'grid', 
        gap: '10px', 
        gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))',
        marginBottom: '20px'
      }}>
        <button 
          onClick={testSingleToast}
          style={buttonStyle}
        >
          Test Single Toast
        </button>
        
        <button 
          onClick={testMultipleToasts}
          style={buttonStyle}
        >
          Test Multiple Toasts
        </button>
        
        <button 
          onClick={testDifferentTypes}
          style={buttonStyle}
        >
          Test Different Types
        </button>
        
        <button 
          onClick={testLongMessage}
          style={buttonStyle}
        >
          Test Long Message
        </button>
        
        <button 
          onClick={testRapidFire}
          style={buttonStyle}
        >
          Test Rapid Fire (10)
        </button>
      </div>

      <div style={{
        backgroundColor: '#f5f5f5',
        padding: '15px',
        borderRadius: '8px',
        marginTop: '20px'
      }}>
        <h3>Expected Behavior:</h3>
        <ul style={{ margin: 0, paddingLeft: '20px' }}>
          <li>Each toast should display for exactly 1 second</li>
          <li>Toasts should appear sequentially, not overlapping</li>
          <li>There should be a 100ms delay between toasts</li>
          <li>No flickering or continuous blinking</li>
          <li>Different types should have different colors</li>
        </ul>
      </div>

      <div style={{
        backgroundColor: '#e7f3ff',
        padding: '15px',
        borderRadius: '8px',
        marginTop: '10px'
      }}>
        <h3>Debug Console:</h3>
        <p>Open browser console to see detailed logs about toast processing.</p>
        <p>You can also run: <code>window.debugImageSystem.testToastQueue()</code></p>
      </div>

      {/* This is where toasts will appear */}
      <ToastContainer />
    </div>
  );
};

const buttonStyle = {
  padding: '10px 15px',
  backgroundColor: '#007bff',
  color: 'white',
  border: 'none',
  borderRadius: '5px',
  cursor: 'pointer',
  fontSize: '14px',
  fontWeight: '500'
};

export default ToastTester;
