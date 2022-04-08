export default function ArticleCard(props: any) {
    return (
    <div className="card bg-light mb-3" style={{maxWidth: "18rem"}}>
        <div className="card-header" style={{color: "black"}}>{props.title}</div>
        <div className="card-body">
        <p className="card-text" style={{color: "black"}}>{props.content}</p>
      </div>
    </div>
    )
}