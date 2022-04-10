interface CardPropsInterface {
    title: object
    content: object
}



export default function ArticleCard({title, content}: CardPropsInterface) {
    return (
    <div className="card bg-light mb-3" style={{maxWidth: "18rem"}}>
        <div className="card-header" style={{color: "black"}}>{title}</div>
        <div className="card-body">
        <p className="card-text" style={{color: "black"}}>{content}</p>
      </div>
    </div>
    )
}