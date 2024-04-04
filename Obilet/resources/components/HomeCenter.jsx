import React from 'react'
import Lottie from 'lottie-react'
import busAnimationGreen from '../assets/busAnimationGreen.json'
import { FaHeadphonesAlt } from "react-icons/fa";
import { RiSecurePaymentLine } from "react-icons/ri";
import { FaWallet } from "react-icons/fa6";
import { FaBus } from "react-icons/fa";

export default function HomeCenter() {
    return (
        <div>
            <div className='flex w-full justify-center items-center mb-[390px]'>
                <Lottie animationData={busAnimationGreen} loop={true} className='w-full absolute -z-50 -top-45' />
            </div>
            <div className='bg-white flex flex-col items-center justify-center mx-48 py-6'>

                <p className='text-black text-4xl font-semibold'> <span className='text-[#08A250] font-bold'>KOÜ</span>'nün Önde Gelen <span className='font-bold'>Otobüs Bileti</span> Sitesi</p>

                <div className='flex flex-row gap-4 mt-12'>
                    <div className='flex flex-col items-center gap-3 border-2 rounded-3xl shadow-sm py-5 px-2'>
                        <FaHeadphonesAlt className='text-[50px]' />
                        <p className='text-2xl font-semibold text-center w-48'>Kesintisiz Müşteri Hizmetleri</p>
                        <p className='max-w-[250px] text-center'>umuttepeturizm.com yapacağınız tüm işlemlerde müşteri hizmetleri ekibimiz 7/24 yanınızda. Bir tıkla destek ekibimize bağlanabilirsiniz. </p>
                    </div >
                    <div className='flex flex-col items-center gap-3 border-2 rounded-3xl shadow-sm py-5 px-2'>
                        <RiSecurePaymentLine className='text-[50px]' />
                        <p className='text-2xl font-semibold text-center'>Güvenli Ödeme</p>
                        <p className='max-w-[250px] text-center'>Tüm otobüs bilet alım işlemlerinizi ister evinizden, ister ofisinizden ya da dilerseniz cep telefonunuzdan kolay, hızlı ve güvenilir bir şekilde gerçekleştirebilirsiniz.</p>

                    </div  >
                    <div className='flex flex-col items-center gap-3 border-2 rounded-3xl shadow-sm py-5 px-2'>
                        <FaWallet className='text-[50px]' />
                        <p className='text-2xl font-semibold text-center'>Öğrenci Dostu</p>
                        <p className='max-w-[250px] text-center'>Umuttepe Turizm size tüm firmaların otobüs biletlerini sorgulama ve karşılaştırma imkanı sunar. Bu sayede bütçenize uygun otobüs biletini rahatlıkla bulabilir ve satın alabilirsiniz.</p>

                    </div  >
                    <div className='flex flex-col items-center gap-3 border-2 rounded-3xl shadow-sm py-5 px-2'>
                        <FaBus className='text-[50px]' />
                        <p className='text-2xl font-semibold text-center'>En İyi Firmalar</p>
                        <p className='max-w-[250px] text-center'>Umuttepe Turizm olarak seçkin otobüs firmalarını sizler için bir araya getirdik. Firmaların otobüs biletlerini obilet'te karşılaştırabilir, uygun otobüs biletini bulabilir ve çevrimiçi bir şekilde satın alabilirsiniz.</p>

                    </div>
                </div>
            </div>
        </div>
    )
}
