import React, { useState, useEffect, createContext } from 'react';

export const AuthContext = createContext();

export const AuthContextProvider = ({ children }) => {

    const loginUser = async (email, password) => {
        try {
            const response = await fetch('authenticate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email: email, sifre: password }) // Stringify the body object
            });
            const data = await response.json();
            console.log(data)
            return data;
        } catch (error) {
            console.log("Error: ", error);
        }
    };

    const getCities = async () => {
        try {
            const response = await fetch('getcities', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });
            const data = await response.json();
            console.log(data)
            return data;
        } catch (error) {
            console.log("Error: ", error);
        }
    };


    const seferleriAl = async (kTerminal, vTerminal, date) => {
        try {
            const response = await fetch('http://localhost:8080/seferlerial', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    "kSehir": kTerminal,
                    "vSehir": vTerminal,
                    "date": date
                })
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.log("Error: ", error);
        }
    };
    
    const pnrKontrol = async (email, pnr) => {
        try {
            const response = await fetch('http://localhost:8080/pnrcontrol', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    "email": email,
                    "pnr": pnr
                })
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.log("Error: ", error);
        }
    };

    return (
        <AuthContext.Provider value={{ loginUser, getCities, seferleriAl, pnrKontrol }}>
            {children}
        </AuthContext.Provider>
    );
};

export default AuthContextProvider;