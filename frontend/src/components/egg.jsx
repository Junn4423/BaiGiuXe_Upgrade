import React, { useState, useEffect, useCallback } from "react";

const EggComponent = ({ onClose, onGameOver }) => {
  // Game state
  const [gameState, setGameState] = useState({
    snake: [{ x: 10, y: 10 }],
    food: { x: 15, y: 15 },
    direction: { x: 0, y: -1 },
    gameOver: false,
    score: 0,
    isPlaying: false,
  });

  // Board dimensions
  const BOARD_WIDTH = 20;
  const BOARD_HEIGHT = 20;

  // Generate new food position
  const generateFood = useCallback((snake) => {
    let newFood;
    do {
      newFood = {
        x: Math.floor(Math.random() * BOARD_WIDTH),
        y: Math.floor(Math.random() * BOARD_HEIGHT),
      };
    } while (
      snake.some(
        (segment) => segment.x === newFood.x && segment.y === newFood.y
      )
    );
    return newFood;
  }, []);

  // Check collision
  const checkCollision = useCallback((head, snake) => {
    // Wall collision
    if (
      head.x < 0 ||
      head.x >= BOARD_WIDTH ||
      head.y < 0 ||
      head.y >= BOARD_HEIGHT
    ) {
      return true;
    }
    // Self collision
    return snake.some(
      (segment) => segment.x === head.x && segment.y === head.y
    );
  }, []);

  // Game loop
  const moveSnake = useCallback(() => {
    setGameState((prevState) => {
      if (prevState.gameOver || !prevState.isPlaying) return prevState;

      const { snake, food, direction, score } = prevState;
      const newSnake = [...snake];
      const head = {
        x: newSnake[0].x + direction.x,
        y: newSnake[0].y + direction.y,
      };

      // Check collision
      if (checkCollision(head, newSnake)) {
        return { ...prevState, gameOver: true };
      }

      newSnake.unshift(head);

      // Check if food eaten
      if (head.x === food.x && head.y === food.y) {
        const newFood = generateFood(newSnake);
        return {
          ...prevState,
          snake: newSnake,
          food: newFood,
          score: score + 10,
        };
      } else {
        newSnake.pop();
        return {
          ...prevState,
          snake: newSnake,
        };
      }
    });
  }, [checkCollision, generateFood]);

  // Handle keyboard input
  const handleKeyPress = useCallback(
    (e) => {
      if (!gameState.isPlaying) return;

      const { direction } = gameState;
      switch (e.key) {
        case "ArrowUp":
          if (direction.y === 0)
            setGameState((prev) => ({ ...prev, direction: { x: 0, y: -1 } }));
          break;
        case "ArrowDown":
          if (direction.y === 0)
            setGameState((prev) => ({ ...prev, direction: { x: 0, y: 1 } }));
          break;
        case "ArrowLeft":
          if (direction.x === 0)
            setGameState((prev) => ({ ...prev, direction: { x: -1, y: 0 } }));
          break;
        case "ArrowRight":
          if (direction.x === 0)
            setGameState((prev) => ({ ...prev, direction: { x: 1, y: 0 } }));
          break;
        case "Escape":
          onClose();
          break;
      }
    },
    [gameState.isPlaying, gameState.direction, onClose]
  );

  // Game loop timer
  useEffect(() => {
    const gameInterval = setInterval(moveSnake, 150);
    return () => clearInterval(gameInterval);
  }, [moveSnake]);

  // Keyboard event listener
  useEffect(() => {
    document.addEventListener("keydown", handleKeyPress);
    return () => document.removeEventListener("keydown", handleKeyPress);
  }, [handleKeyPress]);

  // Handle game over
  useEffect(() => {
    if (gameState.gameOver) {
      setTimeout(() => {
        onGameOver();
      }, 2000);
    }
  }, [gameState.gameOver, onGameOver]);

  // Start game
  const startGame = () => {
    setGameState({
      snake: [{ x: 10, y: 10 }],
      food: { x: 15, y: 15 },
      direction: { x: 0, y: -1 },
      gameOver: false,
      score: 0,
      isPlaying: true,
    });
  };

  // Fake statistics data for disguise
  const fakeStats = {
    totalVehicles: 1247,
    todayEntry: 89,
    todayExit: 76,
    currentParked: 123,
    revenue: "2,340,000 VNĐ",
    occupancyRate: "67%",
  };

  return (
    <div
      style={{
        position: "fixed",
        top: 0,
        left: 0,
        width: "100%",
        height: "100%",
        backgroundColor: "rgba(0, 0, 0, 0.95)",
        zIndex: 10000,
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        fontFamily: "Arial, sans-serif",
      }}
    >
      <div
        style={{
          backgroundColor: "#fff",
          borderRadius: "10px",
          padding: "20px",
          minWidth: "600px",
          textAlign: "center",
          boxShadow: "0 10px 30px rgba(0,0,0,0.3)",
        }}
      >
        {/* Fake Statistics Header */}
        <h2 style={{ color: "#333", marginBottom: "20px" }}>
          📊 Thống Kê Hệ Thống Gửi Xe
        </h2>

        {!gameState.isPlaying && !gameState.gameOver && (
          <div>
            {/* Fake Statistics Display */}
            <div
              style={{
                display: "grid",
                gridTemplateColumns: "repeat(3, 1fr)",
                gap: "15px",
                marginBottom: "20px",
              }}
            >
              <div
                style={{
                  background: "#e3f2fd",
                  padding: "15px",
                  borderRadius: "8px",
                }}
              >
                <h4 style={{ margin: "0 0 5px 0", color: "#1976d2" }}>
                  Tổng Xe
                </h4>
                <p style={{ margin: 0, fontSize: "20px", fontWeight: "bold" }}>
                  {fakeStats.totalVehicles}
                </p>
              </div>
              <div
                style={{
                  background: "#e8f5e8",
                  padding: "15px",
                  borderRadius: "8px",
                }}
              >
                <h4 style={{ margin: "0 0 5px 0", color: "#388e3c" }}>
                  Vào Hôm Nay
                </h4>
                <p style={{ margin: 0, fontSize: "20px", fontWeight: "bold" }}>
                  {fakeStats.todayEntry}
                </p>
              </div>
              <div
                style={{
                  background: "#fff3e0",
                  padding: "15px",
                  borderRadius: "8px",
                }}
              >
                <h4 style={{ margin: "0 0 5px 0", color: "#f57c00" }}>
                  Ra Hôm Nay
                </h4>
                <p style={{ margin: 0, fontSize: "20px", fontWeight: "bold" }}>
                  {fakeStats.todayExit}
                </p>
              </div>
              <div
                style={{
                  background: "#f3e5f5",
                  padding: "15px",
                  borderRadius: "8px",
                }}
              >
                <h4 style={{ margin: "0 0 5px 0", color: "#7b1fa2" }}>
                  Đang Gửi
                </h4>
                <p style={{ margin: 0, fontSize: "20px", fontWeight: "bold" }}>
                  {fakeStats.currentParked}
                </p>
              </div>
              <div
                style={{
                  background: "#e0f2f1",
                  padding: "15px",
                  borderRadius: "8px",
                }}
              >
                <h4 style={{ margin: "0 0 5px 0", color: "#00695c" }}>
                  Doanh Thu
                </h4>
                <p style={{ margin: 0, fontSize: "16px", fontWeight: "bold" }}>
                  {fakeStats.revenue}
                </p>
              </div>
              <div
                style={{
                  background: "#fce4ec",
                  padding: "15px",
                  borderRadius: "8px",
                }}
              >
                <h4 style={{ margin: "0 0 5px 0", color: "#c2185b" }}>
                  Lấp Đầy
                </h4>
                <p style={{ margin: 0, fontSize: "20px", fontWeight: "bold" }}>
                  {fakeStats.occupancyRate}
                </p>
              </div>
            </div>

            {/* Hidden Snake Game Trigger */}
            <p
              style={{ color: "#666", fontSize: "14px", marginBottom: "20px" }}
            >
              Nhấn Space để xem chi tiết thống kê nâng cao...
            </p>
            <button
              onClick={startGame}
              style={{
                background: "linear-gradient(45deg, #2196f3, #21cbf3)",
                color: "white",
                border: "none",
                padding: "12px 30px",
                borderRadius: "25px",
                fontSize: "16px",
                cursor: "pointer",
                marginRight: "10px",
                boxShadow: "0 4px 15px rgba(33, 150, 243, 0.3)",
              }}
            >
              📈 Xem Chi Tiết
            </button>
          </div>
        )}

        {gameState.isPlaying && (
          <div>
            <div
              style={{
                display: "flex",
                justifyContent: "space-between",
                alignItems: "center",
                marginBottom: "10px",
              }}
            >
              <h3 style={{ color: "#333", margin: 0 }}>
                🐍 Snake Game (Disguised)
              </h3>
              <div style={{ color: "#666" }}>Score: {gameState.score}</div>
            </div>

            {/* Game Board */}
            <div
              style={{
                display: "grid",
                gridTemplateColumns: `repeat(${BOARD_WIDTH}, 20px)`,
                gridTemplateRows: `repeat(${BOARD_HEIGHT}, 20px)`,
                gap: "1px",
                backgroundColor: "#ccc",
                border: "2px solid #333",
                margin: "0 auto 20px auto",
                width: "fit-content",
              }}
            >
              {Array.from({ length: BOARD_HEIGHT }, (_, y) =>
                Array.from({ length: BOARD_WIDTH }, (_, x) => {
                  const isSnake = gameState.snake.some(
                    (segment) => segment.x === x && segment.y === y
                  );
                  const isHead =
                    gameState.snake[0].x === x && gameState.snake[0].y === y;
                  const isFood =
                    gameState.food.x === x && gameState.food.y === y;

                  return (
                    <div
                      key={`${x}-${y}`}
                      style={{
                        width: "20px",
                        height: "20px",
                        backgroundColor: isFood
                          ? "#ff6b6b"
                          : isSnake
                          ? isHead
                            ? "#2ecc71"
                            : "#27ae60"
                          : "#ecf0f1",
                      }}
                    />
                  );
                })
              ).flat()}
            </div>

            <p style={{ color: "#666", fontSize: "14px" }}>
              Dùng phím mũi tên để điều khiển • ESC để thoát
            </p>
          </div>
        )}

        {gameState.gameOver && (
          <div>
            <h3 style={{ color: "#e74c3c", margin: "20px 0" }}>
              🚫 GAME OVER!
            </h3>
            <p style={{ fontSize: "18px", color: "#333" }}>
              Điểm số cuối: {gameState.score}
            </p>
            <p
              style={{ color: "#e74c3c", fontWeight: "bold", fontSize: "16px" }}
            >
              ⚠️ Hệ thống sẽ đóng do không cho gửi xe nữa!
            </p>
          </div>
        )}

        <button
          onClick={onClose}
          style={{
            background: "#6c757d",
            color: "white",
            border: "none",
            padding: "10px 20px",
            borderRadius: "5px",
            cursor: "pointer",
            marginTop: "10px",
          }}
        >
          Đóng
        </button>
      </div>
    </div>
  );
};

export default EggComponent;
