import React, { useState } from 'react';
import { motion } from 'framer-motion';
import Header from '../components/Header';
import Footer from '../components/Footer';

const AccordionItem = ({ question, answer }) => {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <div className="border rounded-md my-2">
            <button
                className="flex justify-between items-center rounded-[3px] w-full px-4 py-2 bg-gray-200 text-gray-800"
                onClick={() => setIsOpen(!isOpen)}
            >
                <span>{question}</span>
                <span>{isOpen ? '-' : '+'}</span>
            </button>
            {isOpen && (
                <motion.div
                    initial={{ height: 0 }}
                    animate={{ height: 'auto' }}
                    transition={{ duration: 0.3 }}
                    className="px-4 py-2 bg-white rounded-[9px]"
                >
                    <p className="text-gray-700">{answer}</p>
                </motion.div>
            )}
        </div>
    );
};

const Accordion = ({ items }) => {
    return (
        <div className='w-full'>
            {items.map((item, index) => (
                <AccordionItem key={index} question={item.question} answer={item.answer} />
            ))}
        </div>
    );
};

const faqItems = [
    {
        question: 'Biletimi nasıl iptal edebilirim?',
        answer: 'Biletinizi web sitemizden veya müşteri hizmetleri aracılığıyla iptal edebilirsiniz. İptal politikamız ve ücretlendirme detayları için lütfen şartlar ve koşullarımızı kontrol edin.'
    },
    {
        question: 'Bilet değişikliği yapabilir miyim?',
        answer: 'Bilet değişikliklerini web sitemizden veya müşteri hizmetleri aracılığıyla yapabilirsiniz. Değişiklik yapmadan önce müsaitlik durumunu kontrol etmeyi unutmayın.'
    },
    {
        question: 'İndirimli biletleriniz var mı?',
        answer: 'Belirli tarihler veya grup rezervasyonları için indirimli biletler sunuyoruz. Mevcut indirimlerimizi ve kampanyalarımızı web sitemizden veya uygulamamızdan kontrol edebilirsiniz.'
    },
    {
        question: 'Koltuk seçimi yapabilir miyim?',
        answer: 'Bilet satın alırken koltuk seçimi yapabilirsiniz. Ancak, bazı durumlarda müsaitlik durumuna bağlı olarak koltuk seçimi sınırlı olabilir.'
    },
    {
        question: 'Biletimi nasıl alabilirim?',
        answer: 'Biletinizi web sitemizden veya mobil uygulamamızdan kolayca satın alabilirsiniz. Ödeme seçenekleri arasında kredi kartı, banka kartı ve diğer online ödeme yöntemleri bulunmaktadır.'
    },
    {
        question: 'Seyahat belgelerim hangi bilgileri içermelidir?',
        answer: 'Seyahat belgelerinizde adınız, kalkış ve varış noktaları, seyahat tarihi ve bilet numarası gibi bilgiler bulunmalıdır. Ayrıca, kimlik belgesi veya pasaportunuzu da yanınızda bulundurmayı unutmayın.'
    },
    {
        question: 'Online check-in nasıl yapılır?',
        answer: 'Bazı durumlarda online check-in hizmeti sunuyoruz. Online check-in süreci ve gereksinimleri için lütfen web sitemizi veya müşteri hizmetlerimizi ziyaret edin.'
    }
];

const Sss = () => {
    return (
        <div>
            <Header />
            <div className='flex flex-col items-center mx-[450px] my-10'>
                <h1 className="text-2xl font-bold mb-4">Sık Sorulan Sorular</h1>
                <Accordion items={faqItems} />
            </div>
            <Footer />
        </div>
    );
};

export default Sss;
