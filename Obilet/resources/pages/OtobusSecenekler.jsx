import React, { useState, useEffect, useContext } from 'react';
import { useParams } from 'react-router-dom';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import Login from '../components/Login.jsx'
import Register from '../components/Register.jsx'
import { AuthContext } from '../context.jsx';
import OtobusFirmaListele from '../components/OtobusFirmaListele.jsx';

export default function OtobusSecenekler() {
  const { from_to, date } = useParams(); // Dinamik yol parametrelerini al
  const { seferleriAl } = useContext(AuthContext);
  const [loginButton, setLoginButton] = useState(false)
  const [registerButton, setRegisterButton] = useState(false)
  const [seferler, setSeferler] = useState([]);

  useEffect(() => {
    const terminals = from_to.split('-');
    const from = terminals[0];
    const to = terminals[1];
    seferleriAl(from, to, date)
      .then((seferler) => {
        // Saat kısmı için ayrı bir fonksiyon oluştur
        const extractTimeOnly = (dateTime) => {
          const timeOnly = dateTime.split(' ')[1].split(':').slice(0, 2).join(':');
          return timeOnly;
        };

        // Seferler dizisindeki her bir seferin CikisZamani ve VarisZamani alanlarını güncelle
        const updatedSeferler = seferler.map((sefer) => {
          const cikisDate = new Date(sefer.CikisZamani);
          const varisDate = new Date(sefer.VarisZamani);
          const milisaniyeFarki = varisDate - cikisDate;
          const saatFarki = Math.floor(milisaniyeFarki / (1000 * 60 * 60));
          const dakikaFarki = Math.floor((milisaniyeFarki % (1000 * 60 * 60)) / (1000 * 60));
          let sure = '';
          if (saatFarki > 0) {
            sure = `${saatFarki} Saat`;
            if (dakikaFarki > 0) {
              sure += ` ${dakikaFarki} Dakika`;
            }
          } else if (dakikaFarki > 0) {
            sure = `${dakikaFarki} Dakika`;
          } else {
            sure = '0 Dakika'; // Süre 0 dakika ise yazdır
          }

          return {
            ...sefer,
            CikisZamani: extractTimeOnly(sefer.CikisZamani),
            VarisZamani: extractTimeOnly(sefer.VarisZamani),
            Sure: sure, // Yeni bir alan ekleyerek süreyi sakla
          };
        });
        console.log(updatedSeferler)
        setSeferler(updatedSeferler);
      })
      .catch((error) => {
        console.error('Error fetching seferler:', error);
      });
  }, [from_to, date, seferleriAl]);




  return (
    <div className='flex flex-col gap-10'>
      <Header loginButton={loginButton} setLoginButton={setLoginButton} registerButton={registerButton} setRegisterButton={setRegisterButton} />
      <OtobusFirmaListele seferler={seferler} />
      <Footer />
      <Login loginButton={loginButton} setLoginButton={setLoginButton} registerButton={registerButton} setRegisterButton={setRegisterButton} />
      <Register loginButton={loginButton} setLoginButton={setLoginButton} registerButton={registerButton} setRegisterButton={setRegisterButton} />
    </div>
  )
}
