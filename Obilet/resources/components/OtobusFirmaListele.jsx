import { motion } from 'framer-motion';
import React, { useState } from 'react';
import vib from '../assets/vib.png'
import metro from '../assets/metro.png'
import aliosman from '../assets/aliosman.png'
import duzce from '../assets/duzce.png'
import efetur from '../assets/efetur.png'
import kamilkoc from '../assets/kamilkoc.png'
import pamukkale from '../assets/vib.png'
import { PiFanDuotone } from "react-icons/pi";
import { IoIosArrowDropdown } from "react-icons/io";
import { LuClock9 } from "react-icons/lu";
import { MdEventSeat } from "react-icons/md";
import { IoIosArrowForward } from "react-icons/io";
import { FcCancel } from "react-icons/fc";
import { PiSteeringWheel } from "react-icons/pi";
import Bus from './Bus';
import PurpleSeat from "../assets/purpleseat.svg"
import BlueSeat from "../assets/blueseat.svg"
import GreenSeat from "../assets/greenseat.svg"
import WhiteSeat from "../assets/whiteseat.svg"


export default function OtobusFirmaListele({ seferler }) {
    const [selectedSeferID, setSelectedSeferID] = useState(null);

    const toggleAccordion = (seferID) => {
        setSelectedSeferID(selectedSeferID === seferID ? null : seferID);
    };

    const getFirmaImage = (firmaName) => {
        switch (firmaName) {
            case 'VİB':
                return vib;
            case 'Metro':
                return metro;
            case 'Ali Osman':
                return aliosman;
            case 'Düzce':
                return duzce;
            case 'Efetur':
                return efetur;
            case 'Kamil Koç':
                return kamilkoc;
            case 'Pamukkale':
                return pamukkale;
            default:
                return null; // Return null for unknown firms
        }
    };

    return (
        seferler.map((sefer, index) => (
            <div key={index} className='bg-white flex flex-col border-2 rounded-xl mx-48'>
                <div className='flex flex-row justify-between items-center border-b-2'>
                    <div>
                        <img src={getFirmaImage(sefer.firma_adi)} className='w-36 my-5 mx-4' alt={sefer.Firma + ' Logo'} />
                    </div>
                    <div className='flex flex-col justify-center items-center gap-3'>
                        <div className='flex flex-row justify-center items-center gap-1 text-black'>
                            <LuClock9 className='text-2xl' /> <span className='text-xl font-semibold'>{sefer.CikisZamani}</span>
                        </div>
                        <div >
                            ({sefer.Sure})*
                        </div>
                    </div>
                    <div className='flex flex-col justify-center items-center gap-3'>
                        <div className='flex flex-row justify-center items-center gap-1 text-black'>
                            <MdEventSeat className='text-2xl' /> <span className='text-[22px] font-semibold'>2+1</span>
                        </div>
                        <div className='flex flex-row items-center justify-center gap-1 font-semibold'>
                            İzmit Otogarı <IoIosArrowForward /> Alibeyköy Otogarı
                        </div>
                    </div>
                    <div className='text-2xl font-semibold'>
                        {sefer.fiyat} TL
                    </div>
                    <button onClick={() => toggleAccordion(sefer.SeferID)} className='flex justify-center items-center font-medium bg-[#08A250] text-white px-3 py-2 rounded-[5px] mx-3'>
                        KOLTUK SEÇ
                    </button>
                </div>
                {selectedSeferID === sefer.SeferID && (
                    <motion.div key={sefer.SeferID} className='bg-[#FAFAFA] border-b-2 flex flex-row items-center overflow-hidden' initial={{ height: 0 }} animate={{ height: 'auto' }} transition={{ duration: 0.3 }}>
                        <div className='w-[1010px]'>
                            <button className='border-2 py-1 px-2 rounded-md border-[#B5BBBE] text-[#5D686E] font-semibold m-4'>
                                Sefer Detayları
                            </button>
                            <Bus />
                            <div className='flex flex-row items-center justify-between gap-1 m-4'>
                                <div className='flex flex-row items-center gap-1'>
                                    <FcCancel className='text-xl' /> <span className='font-semibold text-sm'>Biletinizi son 1 saate kadar online iptal edebilirsiniz.</span>
                                </div>
                                <div className='grid grid-cols-2 gap-4'>
                                    <div className='flex flex-row items-center gap-1'>
                                        <img src={BlueSeat} className='w-[20px]' alt={'seat'} /><p className='font-semibold text-sm'>Dolu Koltuk - Erkek</p>
                                    </div>
                                    <div className='flex flex-row items-start gap-1'>
                                        <img src={WhiteSeat} className='w-[20px]' alt={'seat'} /><p className='font-semibold text-sm'>Boş Koltuk</p>
                                    </div>
                                    <div className='flex flex-row items-center gap-1'>
                                        <img src={PurpleSeat} className='w-[20px]' alt={'seat'} /><p className='font-semibold text-sm'>Dolu Koltuk - Kadın</p>
                                    </div>
                                    <div className='flex flex-row items-center gap-1'>
                                        <img src={GreenSeat} className='w-[20px]' alt={'seat'} /><p className='font-semibold text-sm'>Seçilen Koltuk</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className='border-l-2 h-[320px] mb-2 mt-8 flex flex-col justify-between py-1 px-5'>
                            <p className='font-semibold text-sm'>Lütfen soldan koltuk seçin.</p>
                            <button className="bg-[#a2080d] hover:bg-[#91070b] active:bg-[#ab2025] text-white px-3 py-2 rounded-[5px] font-medium transition-all duration-300`}" >
                                ONAYLA VE DEVAM ET
                            </button>
                        </div>
                    </motion.div>
                )}
                <div className='flex flex-row justify-between'>
                    <div className='bg-[#DADBDD] text-[#7C8A9F] flex flex-row gap-1 justify-center items-center rounded-[4px] py-0.5 px-2.5 my-2 mx-5'>
                        <PiFanDuotone className='text-2xl' /> <span className='font-semibold'>Fresh Air</span>
                    </div>
                    <button onClick={() => toggleAccordion(sefer.SeferID)} className='flex flex-row gap-1 justify-center items-center py-0.5 px-3'>
                        <IoIosArrowDropdown className='text-2xl' /> <span className='font-semibold text-lg mb-1'>İncele</span>
                    </button>
                </div>
            </div>
        ))
    )
}