import React, { useEffect, useState } from 'react';
import HomeApi from '../api/HomeApi'

function HomeScreen(props) {

    const [dataUser, setDataUser] = useState([]);

    useEffect(() => {
        (async () => {
            const {data} = await HomeApi.getUsers();
            setDataUser(data);
        })();
    }, []);
    return (
        <div>
            <h1>users / Comande information (DATA) : </h1>
            <div>
                {dataUser.map(user => (
                    <div key={user.idRestaurant}>
                        <h2>Nom : {user.nom}</h2>
                        <h2>Adresse : {user.Adresse}</h2>
                        <h2>menu : {user.Menu}</h2>
                    </div>
                ))}
            </div>
        </div>
    );
}

export default HomeScreen;