import React from 'react';

export default function (props) {
    const vote = props.upvotes - props.downvotes;

    console.log(props);
    return (
        <article className="w-full h-44 bg-amber-700">
            <h2>{props.title}</h2>
            <p>{props.content}</p>
            <p>{props.publisher.username}</p>
            <p>{props.createdAt}</p>
            {/*{props.tags?.map(*/}
            {/*    (tag) => {*/}
            {/*        return <p>{tag}</p>*/}
            {/*    }*/}
            {/*)}*/}

            {/*<p>Upvotes {props.upvotes}</p>*/}
            {/*<p>Downvotes {props.downvotes}</p>*/}
            {/*<p>Comments {props.comments}</p>*/}

        </article>
    );
}
