// "use client";

// import React, { useState, useEffect, useCallback, useRef } from "react";
// import "../../../assets/styles/StatisticsPage.css"; // Sử dụng style của StatisticsPage để giả

// const EggGame = ({ onClose }) => {
//   const [isGameVisible, setIsGameVisible] = useState(false);
//   const [gameState, setGameState] = useState("ready"); // ready, playing, paused, gameOver
//   const [snake, setSnake] = useState([{ x: 10, y: 10 }]);
//   const [food, setFood] = useState({ x: 15, y: 15 });
//   const [direction, setDirection] = useState({ x: 0, y: 1 });
//   const [score, setScore] = useState(0);
//   const [gameSpeed, setGameSpeed] = useState(150);
//   const gameAreaRef = useRef(null);
//   const gameLoopRef = useRef(null);

//   const BOARD_SIZE = 20;

//   // Fake statistics data để giả mạo
//   const fakeStats = {
//     totalRevenue: 15420000,
//     totalVehicles: 1250,
//     totalActive: 89,
//     averageTime: 2.5,
//     peakHours: "14:00 - 16:00",
//     occupancyRate: 85,
//   };

//   // Lắng nghe phím F11 để hiện game
//   useEffect(() => {
//     const handleKeyPress = (event) => {
//       if (event.key === "F10") {
//         event.preventDefault();
//         setIsGameVisible(true);
//         setGameState("ready");
//       }

//       if (isGameVisible && gameState === "playing") {
//         switch (event.key) {
//           case "ArrowUp":
//             if (direction.y === 0) setDirection({ x: 0, y: -1 });
//             break;
//           case "ArrowDown":
//             if (direction.y === 0) setDirection({ x: 0, y: 1 });
//             break;
//           case "ArrowLeft":
//             if (direction.x === 0) setDirection({ x: -1, y: 0 });
//             break;
//           case "ArrowRight":
//             if (direction.x === 0) setDirection({ x: 1, y: 0 });
//             break;
//           case " ":
//             event.preventDefault();
//             togglePause();
//             break;
//           case "Escape":
//             resetGame();
//             break;
//         }
//       }
//     };

//     document.addEventListener("keydown", handleKeyPress);
//     return () => document.removeEventListener("keydown", handleKeyPress);
//   }, [direction, isGameVisible, gameState]);

//   // Game logic
//   const generateFood = useCallback(() => {
//     let newFood;
//     do {
//       newFood = {
//         x: Math.floor(Math.random() * BOARD_SIZE),
//         y: Math.floor(Math.random() * BOARD_SIZE),
//       };
//     } while (
//       snake.some(
//         (segment) => segment.x === newFood.x && segment.y === newFood.y
//       )
//     );
//     return newFood;
//   }, [snake]);

//   const moveSnake = useCallback(() => {
//     setSnake((currentSnake) => {
//       const newSnake = [...currentSnake];
//       const head = { ...newSnake[0] };

//       head.x += direction.x;
//       head.y += direction.y;

//       // Kiểm tra va chạm với tường
//       if (
//         head.x < 0 ||
//         head.x >= BOARD_SIZE ||
//         head.y < 0 ||
//         head.y >= BOARD_SIZE
//       ) {
//         setGameState("gameOver");
//         return currentSnake;
//       }

//       // Kiểm tra va chạm với chính mình
//       if (
//         newSnake.some((segment) => segment.x === head.x && segment.y === head.y)
//       ) {
//         setGameState("gameOver");
//         return currentSnake;
//       }

//       newSnake.unshift(head);

//       // Kiểm tra ăn mồi
//       if (head.x === food.x && head.y === food.y) {
//         setScore((prev) => prev + 10);
//         setFood(generateFood());
//         // Tăng tốc độ game
//         setGameSpeed((prev) => Math.max(prev - 2, 80));
//       } else {
//         newSnake.pop();
//       }

//       return newSnake;
//     });
//   }, [direction, food, generateFood]);

//   // Game loop
//   useEffect(() => {
//     if (gameState === "playing") {
//       gameLoopRef.current = setInterval(moveSnake, gameSpeed);
//     } else {
//       clearInterval(gameLoopRef.current);
//     }

//     return () => clearInterval(gameLoopRef.current);
//   }, [gameState, gameSpeed, moveSnake]);

//   const startGame = () => {
//     setGameState("playing");
//     setSnake([{ x: 10, y: 10 }]);
//     setDirection({ x: 0, y: 1 });
//     setScore(0);
//     setGameSpeed(150);
//     setFood(generateFood());
//   };

//   const togglePause = () => {
//     setGameState((prev) => (prev === "playing" ? "paused" : "playing"));
//   };

//   const resetGame = () => {
//     setGameState("ready");
//     setSnake([{ x: 10, y: 10 }]);
//     setDirection({ x: 0, y: 1 });
//     setScore(0);
//     setGameSpeed(150);
//   };

//   const handleGameOver = () => {
//     // Hiện thông báo "không cho gửi xe nữa" và thoát app
//     alert("GAME OVER! Không cho gửi xe nữa!");
//     // Đóng toàn bộ ứng dụng
//     if (window.electronAPI) {
//       window.electronAPI.closeApp();
//     } else {
//       window.close();
//     }
//   };

//   // Render fake statistics interface
//   const renderFakeStatistics = () => (
//     <div className="statistics-container">
//       <div className="statistics-header">
//         <h1 className="statistics-title">📊 Báo cáo thống kê</h1>
//         <button className="statistics-close-btn" onClick={onClose}>
//           ✕
//         </button>
//       </div>

//       <div className="statistics-body">
//         <div className="statistics-controls">
//           <div className="control-group">
//             <label className="control-label">Thời gian:</label>
//             <select className="time-range-select">
//               <option value="today">Hôm nay</option>
//               <option value="week">Tuần này</option>
//               <option value="month">Tháng này</option>
//             </select>
//           </div>
//           <div style={{ fontSize: "12px", color: "#666", marginTop: "10px" }}>
//             💡 Nhấn F11 để xem báo cáo chi tiết
//           </div>
//         </div>

//         <div className="summary-stats">
//           <div className="stat-card">
//             <div className="stat-value">
//               {fakeStats.totalRevenue.toLocaleString()}đ
//             </div>
//             <div className="stat-label">Tổng doanh thu</div>
//           </div>
//           <div className="stat-card">
//             <div className="stat-value">{fakeStats.totalVehicles}</div>
//             <div className="stat-label">Tổng lượt xe</div>
//           </div>
//           <div className="stat-card">
//             <div className="stat-value">{fakeStats.totalActive}</div>
//             <div className="stat-label">Xe đang gửi</div>
//           </div>
//           <div className="stat-card">
//             <div className="stat-value">{fakeStats.averageTime}h</div>
//             <div className="stat-label">Thời gian TB</div>
//           </div>
//         </div>

//         <div className="charts-container">
//           <div className="chart-card">
//             <h3 className="chart-title">Biểu đồ doanh thu theo giờ</h3>
//             <div className="chart-content">
//               <div
//                 style={{
//                   height: "200px",
//                   background: "linear-gradient(45deg, #f0f9ff, #e0e7ff)",
//                   display: "flex",
//                   alignItems: "center",
//                   justifyContent: "center",
//                   fontSize: "14px",
//                   color: "#666",
//                 }}
//               >
//                 📈 Dữ liệu đang được tải...
//               </div>
//             </div>
//           </div>

//           <div className="chart-card">
//             <h3 className="chart-title">Phân bố loại xe</h3>
//             <div className="chart-content">
//               <div
//                 style={{
//                   height: "200px",
//                   background: "linear-gradient(45deg, #fef3c7, #fde68a)",
//                   display: "flex",
//                   alignItems: "center",
//                   justifyContent: "center",
//                   fontSize: "14px",
//                   color: "#666",
//                 }}
//               >
//                 🥧 Biểu đồ tròn đang tải...
//               </div>
//             </div>
//           </div>
//         </div>
//       </div>
//     </div>
//   );

//   // Render Snake Game
//   const renderSnakeGame = () => (
//     <div
//       className="statistics-overlay"
//       style={{ background: "rgba(0,0,0,0.95)" }}
//     >
//       <div
//         className="statistics-container"
//         style={{
//           maxWidth: "800px",
//           background: "linear-gradient(135deg, #1a1a2e, #16213e)",
//           border: "2px solid #0ea5e9",
//         }}
//       >
//         <div
//           className="statistics-header"
//           style={{ background: "#0f172a", borderBottom: "2px solid #0ea5e9" }}
//         >
//           <h1 className="statistics-title" style={{ color: "#0ea5e9" }}>
//             🐍 SNAKE GAME - Điểm: {score}
//           </h1>
//           <button
//             className="statistics-close-btn"
//             onClick={() => setIsGameVisible(false)}
//             style={{ color: "#ef4444" }}
//           >
//             ✕
//           </button>
//         </div>

//         <div
//           className="statistics-body"
//           style={{ padding: "20px", textAlign: "center" }}
//         >
//           {gameState === "ready" && (
//             <div style={{ color: "white", marginBottom: "20px" }}>
//               <h2 style={{ color: "#0ea5e9", marginBottom: "15px" }}>
//                 🎮 Chào mừng đến với Snake Game!
//               </h2>
//               <p style={{ marginBottom: "10px" }}>
//                 Sử dụng phím mũi tên để điều khiển rắn
//               </p>
//               <p style={{ marginBottom: "10px" }}>
//                 Nhấn SPACE để tạm dừng, ESC để reset
//               </p>
//               <p style={{ marginBottom: "20px", color: "#ef4444" }}>
//                 ⚠️ Cẩn thận: Nếu thua sẽ không được gửi xe nữa!
//               </p>
//               <button
//                 onClick={startGame}
//                 style={{
//                   padding: "12px 30px",
//                   background: "#10b981",
//                   color: "white",
//                   border: "none",
//                   borderRadius: "8px",
//                   fontSize: "16px",
//                   cursor: "pointer",
//                 }}
//               >
//                 🚀 Bắt đầu chơi
//               </button>
//             </div>
//           )}

//           {gameState === "paused" && (
//             <div style={{ color: "white", marginBottom: "20px" }}>
//               <h2 style={{ color: "#f59e0b" }}>⏸️ GAME ĐANG TẠM DỪNG</h2>
//               <p>Nhấn SPACE để tiếp tục</p>
//             </div>
//           )}

//           {gameState === "gameOver" && (
//             <div style={{ color: "white", marginBottom: "20px" }}>
//               <h2 style={{ color: "#ef4444", marginBottom: "15px" }}>
//                 💀 GAME OVER!
//               </h2>
//               <p style={{ fontSize: "18px", marginBottom: "10px" }}>
//                 Điểm của bạn: {score}
//               </p>
//               <p style={{ color: "#ef4444", marginBottom: "20px" }}>
//                 Bạn đã thua! Không được gửi xe nữa!
//               </p>
//               <button
//                 onClick={handleGameOver}
//                 style={{
//                   padding: "12px 30px",
//                   background: "#ef4444",
//                   color: "white",
//                   border: "none",
//                   borderRadius: "8px",
//                   fontSize: "16px",
//                   cursor: "pointer",
//                 }}
//               >
//                 😭 Thoát ứng dụng
//               </button>
//             </div>
//           )}

//           {(gameState === "playing" || gameState === "paused") && (
//             <div
//               ref={gameAreaRef}
//               style={{
//                 display: "grid",
//                 gridTemplateColumns: `repeat(${BOARD_SIZE}, 20px)`,
//                 gridTemplateRows: `repeat(${BOARD_SIZE}, 20px)`,
//                 gap: "1px",
//                 background: "#374151",
//                 padding: "10px",
//                 margin: "0 auto",
//                 width: "fit-content",
//                 border: "3px solid #0ea5e9",
//                 borderRadius: "8px",
//               }}
//             >
//               {Array.from({ length: BOARD_SIZE * BOARD_SIZE }, (_, index) => {
//                 const x = index % BOARD_SIZE;
//                 const y = Math.floor(index / BOARD_SIZE);

//                 const isSnake = snake.some(
//                   (segment) => segment.x === x && segment.y === y
//                 );
//                 const isHead = snake[0] && snake[0].x === x && snake[0].y === y;
//                 const isFood = food.x === x && food.y === y;

//                 let backgroundColor = "#1f2937";
//                 let content = "";

//                 if (isFood) {
//                   backgroundColor = "#ef4444";
//                   content = "🍎";
//                 } else if (isHead) {
//                   backgroundColor = "#10b981";
//                   content = "🟢";
//                 } else if (isSnake) {
//                   backgroundColor = "#059669";
//                   content = "🟩";
//                 }

//                 return (
//                   <div
//                     key={index}
//                     style={{
//                       width: "20px",
//                       height: "20px",
//                       backgroundColor,
//                       display: "flex",
//                       alignItems: "center",
//                       justifyContent: "center",
//                       fontSize: "12px",
//                       borderRadius: "2px",
//                     }}
//                   >
//                     {content}
//                   </div>
//                 );
//               })}
//             </div>
//           )}

//           {(gameState === "playing" || gameState === "paused") && (
//             <div style={{ marginTop: "20px", color: "white" }}>
//               <p>
//                 Tốc độ: {151 - gameSpeed}% | Điểm: {score}
//               </p>
//               <div
//                 style={{
//                   fontSize: "12px",
//                   color: "#94a3b8",
//                   marginTop: "10px",
//                 }}
//               >
//                 Điều khiển: ↑↓←→ | Tạm dừng: SPACE | Reset: ESC
//               </div>
//             </div>
//           )}
//         </div>
//       </div>
//     </div>
//   );

//   // Main render
//   if (isGameVisible) {
//     return renderSnakeGame();
//   }

//   return <div className="statistics-overlay">{renderFakeStatistics()}</div>;
// };

// export default EggGame;
