import React, { useState, useEffect } from 'react';
import KOULogo from '../assets/kouLogo.webp';
import { GoDotFill } from 'react-icons/go';
import { useNavigate } from 'react-router-dom';
import toast, { Toaster } from 'react-hot-toast';

export default function Header({ loginButton, setLoginButton }) {
    const navigate = useNavigate();
    const [isLoggedIn, setIsLoggedIn] = useState(!!sessionStorage.getItem('KullaniciID'));

    // Çıkış yap fonksiyonu
    const handleLogout = () => {
        sessionStorage.clear();
        setIsLoggedIn(false);
        toast.success('Çıkış Yapıldı!');
    };

    // KullaniciID'yi sessionStorage'den al
    const KullaniciID = sessionStorage.getItem('KullaniciID');

    // sessionStorage'deki değişiklikleri takip etmek için useEffect kullan
    useEffect(() => {
        setIsLoggedIn(!!sessionStorage.getItem('KullaniciID')); // Kullanıcı oturum durumuna göre durumu güncelle
    }, [KullaniciID]);

    return (
        <div className='bg-[#08A250] mb-8'>
            <div className='text-white flex flex-row items-center justify-between mx-48 py-4'>
                <button onClick={() => navigate('/home')} className='flex flex-row items-center justify-center gap-3'>
                    <img src={KOULogo} className='w-20' alt="Kocaeli Universitesi Logo" />
                    <p className='deneme flex flex-col'>Umuttepe <br /><span className='break-words text-left'>Turizm</span></p>
                </button>

                <div className='flex flex-row items-center text-center'>
                    <button onClick={() => navigate('/sss')} className='text-xl font-semibold'>S.S.S</button>
                    <GoDotFill className='mx-3 text-xs' />
                    <button onClick={() => navigate('/pnr-sorgu')} className='text-xl font-semibold'>Seyahat Sorgula</button>
                    {isLoggedIn ? (
                        <>
                            <GoDotFill className='mx-3 text-xs' />
                            <button onClick={() => navigate('/biletlerim')} className='text-xl font-semibold'>Biletlerim</button>
                            <GoDotFill className='mx-3 text-xs' />
                            <button onClick={handleLogout} className='text-xl font-semibold'>Çıkış Yap</button>
                        </>
                    ) : (
                        <>
                            <GoDotFill className='mx-3 text-xs' />
                            <button onClick={() => setLoginButton(!loginButton)} className='text-xl font-semibold'>Üye Girişi</button>
                        </>
                    )}
                </div>
            </div>
        </div>
    )
}