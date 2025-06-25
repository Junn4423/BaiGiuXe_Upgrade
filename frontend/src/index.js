import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';
import Login from './views/Login';
import MainUI from './views/main/main_UI';

const App = () => {
  const [loggedIn, setLoggedIn] = useState(false);

  return loggedIn ? (
    <MainUI />
  ) : (
    <Login onLoginSuccess={() => setLoggedIn(true)} />
  );
};

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
