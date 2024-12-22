import React from 'react';

export default function () {
    return (
        <div className="p-3 flex flex-col gap-8">
            <h2>Admin dashboard</h2>

            <div className="flex gap-4">
                <a className="p-3 border rounded-full" href="/publication">Publications</a>
                <a className="p-3 border rounded-full" href="/comment">Commentaires</a>
                <a className="p-3 border rounded-full" href="/tag">Tags</a>
                <a className="p-3 border rounded-full" href="/reaction">Reactions</a>
                <a className="p-3 border rounded-full" href="/user">Utilisateurs</a>
            </div>
        </div>
    );
};
