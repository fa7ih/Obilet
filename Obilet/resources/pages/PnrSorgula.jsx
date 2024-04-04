import React, { useState, useEffect, useContext } from 'react';
import Header from '../components/Header.jsx';
import OtobusSorgu from '../components/OtobusSorgu.jsx';
import HomeCenter from '../components/HomeCenter.jsx';
import Footer from '../components/Footer.jsx';
import Login from '../components/Login.jsx'
import Dropdown from '../components/Dropdown.jsx';
import { AuthContext } from '../context.jsx';

export default function PnrSorgula() {

  const { pnrKontrol } = useContext(AuthContext);

  useEffect(() => {
    pnrKontrol("eray@mail.com", "deneme")
      .then((bilet) => {  
      console.log(bilet)
    })
  })
  

  return (
    <div>
      <Header />
      <div className='bg-white flex flex-col gap-10 border-2 rounded-xl shadow-sm items-center justify-center mx-[500px] py-6 my-12'>
        <p className='font-medium text-2xl'><span className='text-gray-700 font-semibold'>PNR</span> Numaranız ile Biletinizi Sorgulayın</p>
        <div>
          <input className='border border-gray-300 rounded-md mb-4 py-2 px-4 block w-full' type="text" placeholder="PNR No" />
          <input className='border border-gray-300 rounded-md mb-6 py-2 px-4 block w-full' type="password" placeholder="E-Posta" />
          <button className='bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md w-full'>Biletimi Sorgula</button>
        </div>
        <p className='text-xs font-semibold'>PNR numaranızı bulmak için onay e-mail veya Cep telefonunuzu kontrol ediniz. </p>
      </div>
      <Footer />
    </div>
  )
}
