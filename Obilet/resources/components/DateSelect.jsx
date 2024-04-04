import React, { useState, useRef } from 'react';
import DatePicker from 'react-datepicker';
import tr from 'date-fns/locale/tr'; // Türkçe dil desteği
import 'react-datepicker/dist/react-datepicker.css';
import './customDatePickerCss.css';

export default function DateSelect({ selectedDate, setSelectedDate }) {
    const [isTopTextGreen, setIsTopTextGreen] = useState(false);
    const datePickerRef = useRef();

    const handleButtonClick = () => {
        datePickerRef.current.setOpen(true); // Date picker'ı aç
    };

    const handleFocus = () => {
        setIsTopTextGreen(true); // Odaklandığında yeşile dön
    };

    const handleBlur = () => {
        setIsTopTextGreen(false); // Odak kaybolduğunda eski rengine dön
    };

    const handleDateChange = (date) => {
        setSelectedDate(date); // Seçilen tarihi ana bileşene iletiyoruz
        console.log(date)
        datePickerRef.current.setOpen(false); // Date picker'ı kapat
    };

    const dayClassName = (date) => {
        const isBeforeYesterday = date < new Date(new Date().setDate(new Date().getDate() - 1));
        return isBeforeYesterday ? 'before-yesterday' : '';
    };

    return (
        <button
            onClick={handleButtonClick}
            onFocus={handleFocus}
            onBlur={handleBlur}
            className={`bg-[#F4F5F5] flex flex-col items-center px-3 justify-center py-1.5 ${
                isTopTextGreen ? 'border-[#08A250] border-2' : 'border-[#F4F5F5] border-2'
            }  hover:border-[#08A250] rounded-2xl hover:shadow-lg transition-all duration-300`}
        >
            <p className={`text-left ${isTopTextGreen ? 'text-[#08A250]' : ''}`}>
                Gidiş Tarihi
            </p>
            <DatePicker
                monthsShown={2}
                ref={datePickerRef}
                className="bg-[#F4F5F5] font-semibold text-xl text-center w-32 focus:outline-none"
                dateFormat="dd MMM EEE" // "22 Mar Cuma" formatı
                selected={selectedDate}
                onChange={handleDateChange} // Handle date change and close date picker
                locale={tr} // Türkçe dil desteği
                minDate={new Date()} // Bugünden önceki tarih seçilemez
                dayClassName={dayClassName} // Günler için özel sınıf atama
            />
        </button>
    );
}