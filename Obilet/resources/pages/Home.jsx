import React, { useState, useEffect, useContext } from 'react';
import Header from '../components/Header.jsx';
import OtobusSorgu from '../components/OtobusSorgu.jsx';
import HomeCenter from '../components/HomeCenter.jsx';
import Footer from '../components/Footer.jsx';
import Login from '../components/Login.jsx'
import Register from '../components/Register.jsx'

export const Home = () => {
  
  const [loginButton, setLoginButton] = useState(false)
  const [registerButton, setRegisterButton] = useState(false)


  return (
    <div className='flex flex-col gap-10'>
      <Header loginButton={loginButton} setLoginButton={setLoginButton} registerButton={registerButton} setRegisterButton={setRegisterButton} />
      <OtobusSorgu />
      <HomeCenter />
      <Footer />
      <Login loginButton={loginButton} setLoginButton={setLoginButton} registerButton={registerButton} setRegisterButton={setRegisterButton}/>
      <Register loginButton={loginButton} setLoginButton={setLoginButton} registerButton={registerButton} setRegisterButton={setRegisterButton}/>
    </div>
  );
};
