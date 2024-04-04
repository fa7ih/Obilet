import React from 'react'
import { PiSteeringWheel } from "react-icons/pi";
import PurpleSeat from "../assets/purpleseat.svg"
import BlueSeat from "../assets/blueseat.svg"
import GreenSeat from "../assets/greenseat.svg"
import WhiteSeat from "../assets/whiteseat.svg"


export default function Bus() {

    const seatNumbers = Array.from({ length: 52 }, (_, index) => index + 1);


    return (
        <div className='flex flex-row'>
            <div className='flex items-end border-2 border-r-0 w-[100px] h-[220px] rounded-l-3xl ml-24'>
                <PiSteeringWheel className='text-[60px] -rotate-90 text-gray-400 m-3' />
            </div>
            <div className='flex flex-col justify-between border-2 border-l-0 border-r-0 w-[645px] h-[220px]'>
                <div>
                    <div className='py-4 grid grid-cols-13 gap-x-2.5'>
                        {seatNumbers.slice(0, 13).map(seatNumber => (
                            <div key={seatNumber} className='relative'>
                                {seatNumber !== 8 && (
                                    <img src={WhiteSeat} className='w-[40px] absolute inset-0' alt={'seat'} />
                                )}
                                {seatNumber !== 8 && (
                                    <div className={`absolute inset-0 top-2 ${seatNumber > 9 ? "left-2" : "left-3.5"}`}>{seatNumber}</div>
                                )}
                            </div>
                        ))}
                        <div>
                            a
                        </div>
                    </div>
                    <div className='pt-2 grid grid-cols-13 gap-x-2.5'>
                        {seatNumbers.slice(13, 26).map(seatNumber => (
                            <div key={seatNumber} className='relative'>
                                {seatNumber !== 21 && (
                                    <img src={WhiteSeat} className='w-[40px] absolute inset-0' alt={'seat'} />
                                )}
                                {seatNumber !== 21 && (
                                    <div className={`absolute inset-0 top-2 ${seatNumber > 9 ? "left-2" : "left-3.5"}`}>{seatNumber}</div>
                                )}
                            </div>
                        ))}
                        <div>
                            a
                        </div>
                    </div>
                </div>
                <div className='py-4 grid grid-cols-13 gap-x-2.5 gap-y-3'>
                    {seatNumbers.slice(26, 39).map(seatNumber => (
                        <div key={seatNumber} className='relative'>
                            <img src={WhiteSeat} className='w-[40px] absolute inset-0' alt={'seat'} />
                            <div className={`absolute inset-0 top-2 ${seatNumber > 9 ? "left-2" : "left-3.5"}`}>{seatNumber}</div>
                        </div>
                    ))}
                    <div>
                        a
                    </div>
                </div>
            </div>
            <div className='border-2 border-l-0 w-[40px] h-[220px] rounded-r-xl'>
            </div>
        </div>
    )
}
