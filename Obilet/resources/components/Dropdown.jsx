// Dropdown.jsx
import React, { useState, useEffect, useRef } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { FaAngleDown } from 'react-icons/fa';

const Dropdown = ({ topText, buttons, setSelected, selected }) => {
  const [isOpen, setIsOpen] = useState(false);
  const dropdownRef = useRef(null);
  const [isTopTextGreen, setIsTopTextGreen] = useState(false);

  const toggleDropdown = () => {
    setIsOpen(!isOpen);
  };

  const handleClickOutside = (event) => {
    if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
      setIsOpen(false);
      setIsTopTextGreen(false); // Dropdown dışına tıklanınca yeşil rengi kaldır
    }
  };

  useEffect(() => {
    document.addEventListener('mousedown', handleClickOutside);

    return () => {
      document.removeEventListener('mousedown', handleClickOutside);
    };
  }, []);

  useEffect(() => {
    document.addEventListener('mousedown', handleClickOutside);

    return () => {
      document.removeEventListener('mousedown', handleClickOutside);
    };
  }, []);

  const dropdownVariants = {
    hidden: { opacity: 0, y: -5 },
    visible: { opacity: 1, y: 0 },
  };

  const arrowVariants = {
    open: { rotate: -180 },
    closed: { rotate: 0 },
  };

  const handleSelection = (label) => {
    console.log(label)
    setSelected(label)
    setIsOpen(false);
  };

  const handleInputChange = (e) => {
    setSelected(e.target.value);
  };

  const handleFocus = () => {
    setIsTopTextGreen(true);
  };

  const handleBlur = () => {
    setIsTopTextGreen(false);
  };

  return (
    <div ref={dropdownRef} className="relative inline-block text-left w-full">
      <button
        onClick={toggleDropdown}
        className={`inline-flex bg-[#F4F5F5] items-center gap-3.5 py-1.5 px-3 justify-between w-64 ${isTopTextGreen ? 'border-[#08A250] border-2' : 'border-[#F4F5F5] border-2'}  hover:border-[#08A250] rounded-2xl hover:shadow-sm transition-all duration-300`}
      >
        <div className='flex flex-col ml-2'>
        <p className={` text-left ${isTopTextGreen ? 'text-[#08A250]' : ''}`}>{topText}</p>

          {isOpen ?
            <input
              autoFocus 
              type="text"
              onFocus={handleFocus}
              onBlur={handleBlur}
              value={selected}
              onChange={handleInputChange}
              onClick={(e) => e.stopPropagation()}
              className="bg-[#F4F5F5] border-none max-w-[195px] font-semibold text-xl focus:outline-none"
            />

            :

            (selected == "" ?
              <p className='text-left text-lg'>
                İl adı yazın
              </p> :
              <p className='text-left font-semibold text-xl'>
              {selected}
              </p>
            )
          }
        </div>
        
        <motion.span
          animate={isOpen ? 'open' : 'closed'}
          variants={arrowVariants}
        >
          <FaAngleDown className="text-xl" />
        </motion.span>
      </button>

      <AnimatePresence>
        {isOpen && (
          <motion.div
            initial="hidden"
            animate="visible"
            exit="hidden"
            variants={dropdownVariants}
            className="absolute z-50 w-full mt-1 rounded-2xl border-2 bg-white border-gray-200 shadow-md hover:border-[#08A250] hover:shadow-lg transition-all duration-300"
          >
            <div
              className="py-1"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="options-menu"
            >
              {buttons.map((button, index) => (
                <button
                  key={index}
                  onClick={() => handleSelection(button.label)}
                  className={button.className}
                  role="menuitem"
                >
                  {button.label}
                </button>
              ))}
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </div>
  );
};

export default Dropdown;