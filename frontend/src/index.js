import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';
import Login from './views/Login';
import MainUI from './views/main/main_UI';
import { UserProvider, useUser } from './utils/userContext';

const App = () => {
  const [loggedIn, setLoggedIn] = useState(false);

  const handleLoginSuccess = async (loginData) => {
    console.log('🔐 Login thành công với dữ liệu:', loginData);
    setLoggedIn(true);
  };

  return (
    <UserProvider>
      {loggedIn ? (
        <MainUIWithUser />
      ) : (
        <Login onLoginSuccess={handleLoginSuccess} />
      )}
    </UserProvider>
  );
};

// Component wrapper để sử dụng useUser hook
const MainUIWithUser = () => {
  return <MainUI />;
};

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<App />);
