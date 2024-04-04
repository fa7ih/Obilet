import React from 'react';
import { FaClockRotateLeft } from "react-icons/fa6";
import { FaLock } from "react-icons/fa";
import { FaWallet } from "react-icons/fa";

const Footer = () => {
    return (
        <footer className="py-8 bg-[#FAFAFA] border-t-2">
            <div className="container mx-auto px-4">
                <div className="flex justify-between gap-8 mx-48">
                    <div className='text-left'>
                        <div className='flex flex-row items-center gap-3 text-2xl mb-6'>
                            <FaLock className='text-3xl' />
                            <p className='font-semibold'>Güvenilir</p>
                        </div>
                        <h3 className="text-xl font-semibold mb-4 gap-0.5">Kocaeli Turizm</h3>
                        <p>Adres: Umuttepe, Teknoloji Fak. Bilişim Sis. Müh.</p>
                        <p>Telefon: 000 000 0000</p>
                        <p>E-posta: umuttepe@umuttepe.umuttepe</p>
                    </div>
                    <div className='text-left'>
                        <div className='flex flex-row items-center gap-3 text-2xl mb-6'>
                            <FaClockRotateLeft className='text-3xl' />
                            <p className='font-semibold'>Hızlı</p>

                        </div>
                        <h3 className="text-xl font-semibold mb-4">Popüler Otobüs Firmaları</h3>
                        <div className="flex flex-col gap-1">
                            <div href="/hakkimizda">Manisa Seyahat</div>
                            <div href="/gizlilik-politikasi">Kamil Koç</div>
                            <div href="/iletisim">Metro</div>
                            <div href="/sartlar-ve-kosullar">Efe Tur</div>
                        </div>
                    </div>
                    <div className='text-left'>
                        <div className='flex flex-row items-center gap-3 text-2xl mb-6'>
                            <FaWallet className='text-3xl' />
                            <p className='font-semibold'>Ekonomik</p>
                        </div>
                        <h3 className="text-xl font-semibold mb-4">Umuttepe Turizm</h3>
                        <div className="flex flex-col gap-1">
                            <div href="/hakkimizda">Hakkımızda</div>
                            <div href="/gizlilik-politikasi">Gizlilik Politikası</div>
                            <div href="/iletisim">İletişim</div>
                            <div href="/sartlar-ve-kosullar">Şartlar ve Koşullar</div>
                        </div>
                    </div>
                </div>
                <div className="text-center mt-8">
                    <p className='text-red-700 font-semibold'>Dikkat! Üniversite Projesidir Bu Websitesinin Hiçbir Geçerliliği Yoktur</p>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
