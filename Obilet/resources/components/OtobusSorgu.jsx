import React, { useState, useEffect, useContext } from 'react';
import Dropdown from './Dropdown';
import DateSelect from './DateSelect';
import { FaSearch } from "react-icons/fa";
import { useNavigate } from 'react-router-dom';
import { AuthContext } from '../context'; // Assuming you have an AuthContext

export default function OtobusSorgu() {
    const { getCities } = useContext(AuthContext); // Assuming AuthContext provides getCities function
    const navigate = useNavigate();
    const [cities, setCities] = useState([]);
    const [selectedNereden, setSelectedNereden] = useState("");
    const [selectedNereye, setSelectedNereye] = useState("");
    const [selectedDate, setSelectedDate] = useState(new Date());
    const [dateType, setDateType] = useState('today'); // 'today' veya 'tomorrow'

    useEffect(() => {
        const fetchCities = async () => {
            try {
                const citiesData = await getCities();
                setCities(citiesData);
            } catch (error) {
                console.error('Error fetching cities:', error);
            }
        };

        fetchCities();
    }, [getCities]);

    const handleDateTypeChange = (e) => {
        const value = e.target.value;
        setDateType(value);

        if (value === 'today') {
            setSelectedDate(new Date()); // Bugünün tarihi
        } else if (value === 'tomorrow') {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1); // Yarının tarihi
            setSelectedDate(tomorrow);
        }
    };

    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };

    const searchBusHandle = () => {
        formatDate(selectedDate)
        const neredenId = cities.find(city => city.SehirAdi === selectedNereden)?.SehirID;
        const nereyeId = cities.find(city => city.SehirAdi === selectedNereye)?.SehirID;

        if (neredenId && nereyeId) {
            const url = `/seferler/${neredenId}-${nereyeId}/${formatDate(selectedDate)}`;
            navigate(url);
        } else {
            console.error('City IDs not found');
        }
    };

    return (
        <div className='bg-white flex border-2 rounded-3xl shadow-sm flex-row items-center justify-between mx-48 py-6'>
            <div className='mx-8 flex flex-row gap-6 w-full'>
                <div className='flex flex-col'>
                    <Dropdown
                        topText="Nereden"
                        buttons={cities.map((city, index) => ({
                            label: city.SehirAdi,
                            className: index === cities.length - 1 ? 'w-full px-4 py-2 hover:text-zinc-800 text-left' : 'w-full px-4 py-2 border-b-2 hover:text-zinc-800 text-left'
                        }))}
                        setSelected={setSelectedNereden}
                        selected={selectedNereden}
                    />
                </div>
                <div className='flex flex-col'>
                    <Dropdown
                        topText="Nereye"
                        buttons={cities.map((city, index) => ({
                            label: city.SehirAdi,
                            className: index === cities.length - 1 ? 'w-full px-4 py-2 hover:text-zinc-800 text-left' : 'w-full px-4 py-2 border-b-2 hover:text-zinc-800 text-left'
                        }))}
                        setSelected={setSelectedNereye}
                        selected={selectedNereye}
                    />
                </div>
                <div className='flex flex-row gap-6'>
                    <DateSelect selectedDate={selectedDate} setSelectedDate={setSelectedDate} />
                    <div className='flex flex-col justify-center gap-1'>
                        <div className="flex items-center">
                            <input
                                type="radio"
                                id="today-radio"
                                value="today"
                                name="date-radio"
                                checked={dateType === 'today'}
                                onChange={handleDateTypeChange}
                            />
                            <label
                                htmlFor="today-radio"
                                className="ms-2 text-base font-semibold text-gray-900 mb-1"
                            >
                                Bugün
                            </label>
                        </div>
                        <div className="flex items-center">
                            <input
                                type="radio"
                                id="tomorrow-radio"
                                value="tomorrow"
                                name="date-radio"
                                checked={dateType === 'tomorrow'}
                                onChange={handleDateTypeChange}
                            />
                            <label
                                htmlFor="tomorrow-radio"
                                className="ms-2 text-base font-semibold text-gray-900 mb-1"
                            >
                                Yarın
                            </label>
                        </div>
                    </div>
                </div>
                <button onClick={() => searchBusHandle()} className="flex flex-row justify-center items-center gap-3 bg-[#a2080d] hover:bg-[#91070b] active:bg-[#ab2025] w-full text-xl font-semibold text-white py-2 px-4 rounded-2xl transition-all duration-300`}" >
                    Otobüs Ara <FaSearch />
                </button>
            </div>
        </div>
    )
}
