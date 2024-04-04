import React, { useContext, useState } from 'react';
import { motion, AnimatePresence } from "framer-motion";
import { RxCross2 } from "react-icons/rx";
import { AuthContext } from '../context.jsx';

export default function Register({ loginButton, setLoginButton, registerButton, setRegisterButton }) {


    const [adi, setAdi] = useState('');
    const [soyadi, setSoyadi] = useState('');
    const [dogumTarihi, setDogumTarihi] = useState('');
    const [cinsiyet, setCinsiyet] = useState('');
    const [cepTelefonu, setCepTelefonu] = useState('');
    const [email, setEmail] = useState('');
    const [tckn, setTckn] = useState('');
    const [sifre, setSifre] = useState('');

    

    const handleClickOutside = (e) => {
        if (e.target === e.currentTarget) {
            setLoginButton(!loginButton);
        }
    };

    const handleLogin = () => {
        setRegisterButton(!registerButton)
        setLoginButton(!loginButton)
    }

    const handleRegisterUser = async () => {

    }

    return (
        <AnimatePresence>
            {registerButton &&
                <motion.div
                    className='fixed inset-0 flex items-center justify-center z-50'
                    initial={{ opacity: 0, backgroundColor: "rgba(0, 0, 0, 0)" }}
                    animate={{ opacity: 1, backgroundColor: "rgba(0, 0, 0, 0.2)" }}
                    exit={{ opacity: 0, backgroundColor: "rgba(0, 0, 0, 0)" }}
                    onClick={handleClickOutside}
                >
                    <div className='relative flex flex-col bg-white rounded-lg shadow-lg transition-all duration-300 w-80 mx-auto'>
                        <div className='flex flex-row justify-between items-center py-4 px-8 font-semibold text-2xl text-center bg-gray-200 rounded-t-lg'>
                            <p>Kayıt Ol</p>
                            <button onClick={() => setRegisterButton(!registerButton)}>
                                <RxCross2 />
                            </button>
                        </div>
                        <div className="p-6">
                            <div className='flex flex-row gap-3'>
                                <input className='border border-gray-300 rounded-md mb-4 py-2 px-4 block w-full' type="text" placeholder="Ad" value={adi} onChange={(e) => setAdi(e.target.value)} />
                                <input className='border border-gray-300 rounded-md mb-4 py-2 px-4 block w-full' type="text" placeholder="Soyad" value={soyadi} onChange={(e) => setSoyadi(e.target.value)} />
                            </div>
                            <input className='border border-gray-300 rounded-md mb-4 py-2 px-4 block w-full' type="text" placeholder="Doğum Tarihi" value={dogumTarihi} onChange={(e) => setDogumTarihi(e.target.value)} />
                            <input className='border border-gray-300 rounded-md mb-6 py-2 px-4 block w-full' type="text" placeholder="Cinsiyet" value={cinsiyet} onChange={(e) => setCinsiyet(e.target.value)} />
                            <input className='border border-gray-300 rounded-md mb-4 py-2 px-4 block w-full' type="text" placeholder="Telefon" value={cepTelefonu} onChange={(e) => setCepTelefonu(e.target.value)} />
                            <input className='border border-gray-300 rounded-md mb-6 py-2 px-4 block w-full' type="text" placeholder="Email" value={email} onChange={(e) => setEmail(e.target.value)} />
                            <input className='border border-gray-300 rounded-md mb-6 py-2 px-4 block w-full' type="text" placeholder="TCKN" value={tckn} onChange={(e) => setTckn(e.target.value)} />
                            <input className='border border-gray-300 rounded-md mb-6 py-2 px-4 block w-full' type="password" placeholder="Şifre" value={sifre} onChange={(e) => setSifre(e.target.value)} />
                            <button onClick={() => handleRegisterUser()} className='bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md w-full'>Üye Ol</button>
                            <p className='text-gray-600 text-sm mt-3 text-center'>Hesabınız var mı? <button onClick={() => handleLogin()} className='text-green-600 font-semibold'>Giriş Yap</button></p>
                        </div>
                    </div>
                </motion.div>}
        </AnimatePresence>
    );
}
