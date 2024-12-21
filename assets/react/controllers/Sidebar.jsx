import React from 'react';

export default function (props) {
    return (
        <>
            <div className="flex items-center justify-evenly ">
                <img src="/assets/iconmonstr-reddit-4.svg" alt="Reddito" className="w-16"     style={{ filter: "invert(21%) sepia(97%) saturate(340%) hue-rotate(219deg) brightness(95%) contrast(93%)" }}/>
                <h1 className="text-center text-3xl">Reddito</h1>
            </div>
            <a href='/' className='py-2 px-4 rounded-full bg-slate-900'>Accueil</a>
            {props.isConnected && <a href='/profile' className="py-2 px-4">Mon compte</a>}
            {props.isAdmin?.some((element) => element == "ROLE_ADMIN") && <a href='/admin' className="py-2 px-4">Admin</a>}
            {props.isConnected ? <a href='/logout' className='py-2 px-4'>Deconnexion</a> : <a href='/login' className='py-2 px-4 bg-slate-600 rounded-full'>Connexion</a>}
        </>
    );
}