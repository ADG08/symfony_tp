import React, {Fragment} from 'react';
import PublicationCard from "../components/PublicationCard";

export default function (props) {
    return (
        <>
            {!props.username ? (
                <div className="flex flex-col p-3 gap-2">
                    {props.publications?.map(
                        (publication) => {
                            return (
                                <Fragment key={publication.id}>
                                    <PublicationCard title={publication.title} content={publication.content} publisher={publication.publisher} reactions={publication.reactions} tags={publication.tags} createdAt={publication.createdAt} comments={publication.comments.length}/>
                                    <hr className="border-b border-slate-gray"/>
                                </Fragment>
                            )
                        }
                    )}

                </div>
            ) : (
                <p>You need to connect</p>
            )}
        </>
    );
}
