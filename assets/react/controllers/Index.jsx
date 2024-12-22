import React, { Fragment } from 'react';
import PublicationCard from "../components/PublicationCard";

export default function (props) {
    const [tagFilter, setTagFilter] = React.useState(null);

    const handleTagFilter = (value) => {
        setTagFilter(value);
        console.log(filteredPublications);
    };

    const filteredPublications = tagFilter
        ? props.publications?.filter((publication) =>
            publication.tags.some((tag) => tag.label === tagFilter)
        )
        : props.publications;

    return (
        <>
            {props.username ? (
                <div className="flex flex-col p-3 gap-2">
                    <div className="flex gap-2">
                        {props.tags?.map((tag) => (
                            <button
                                key={tag.label}
                                className={`${tagFilter === tag.label ? 'bg-blue-500' : 'bg-slate-gray'} text-white px-2 py-1 rounded-md `}
                                onClick={() => handleTagFilter(tag.label)}
                            >
                                {tag.label}
                            </button>
                        ))}
                        <button
                            className="bg-red-500 text-white px-2 py-1 rounded-md"
                            onClick={() => setTagFilter(null)}
                        >
                            Clear Filter
                        </button>
                    </div>

                    {/* Filtered publications */}
                    {filteredPublications
                        ?.sort(
                            (a, b) =>
                                new Date(b.createdAt) - new Date(a.createdAt)
                        )
                        .map((publication) => (
                            <Fragment key={publication.id}>
                                <PublicationCard
                                    id={publication.id}
                                    title={publication.title}
                                    content={publication.content}
                                    publisher={publication.publisher}
                                    reactions={publication.reactions}
                                    tags={publication.tags}
                                    createdAt={publication.createdAt}
                                    comments={publication.comments.length}
                                />
                                <hr className="border-b border-slate-gray" />
                            </Fragment>
                        ))}
                </div>
            ) : (
                <p>You need to connect</p>
            )}
        </>
    );
}
