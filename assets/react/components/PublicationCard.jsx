import React from 'react';

export default function (props) {
    let vote = 0;
    props.reactions.forEach((x) => {
        switch (x.type) {
            case "upvote":
                vote++;
                break;
            case "downvote":
                vote--;
                break;
            default:
                break;
        }
    });

    const timeAgo = (date) => {
        const now = new Date();
        const postDate = new Date(date);
        const diffMs = now - postDate;
        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
        const diffMinutes = Math.floor(diffMs / (1000 * 60));

        if (diffDays > 0) {
            return `${diffDays}d`;
        } else if (diffHours > 0) {
            return `${diffHours}h`;
        } else if (diffMinutes > 0) {
            return `${diffMinutes}m`;
        }
        return "Just now";
    };

    return (
        <a href={`/publication/${props.id}`} className="flex flex-col gap-2 px-4 pb-4 pt-2 bg-indigo-950 hover:bg-indigo-800">
            <div className="flex items-center justify-between text-xs">
                <div className="flex items-center gap-4">
                    <p>{props.publisher.username}</p>
                    <p>{timeAgo(props.createdAt)}</p>
                </div>
                <div className="flex items-center gap-4">
                    {props.tags?.map((tag) => (
                        <p key={tag?.id} className="border py-1 px-2 rounded-full">{tag?.label}</p>
                    ))}

                </div>
            </div>
            <h2>{props.title}</h2>
            <div className="flex items-center justify-between ">
                <div className="flex items-center border py-1 px-2 rounded-full gap-2">
                    <img src="/assets/icon_upvote.svg" alt="upvote" className="w-6 aspect-square"
                         style={{filter: 'invert(100%)'}}></img>
                    <p>{vote}</p>
                    <img src="/assets/icon_upvote.svg" alt="upvote" className="w-6 aspect-square rotate-180"
                         style={{filter: 'invert(100%)'}}></img>
                </div>
                <p className="border py-1 px-2 rounded-full">Comments {props.comments}</p>
            </div>
        </a>
    );
}
