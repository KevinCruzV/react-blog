import React from 'react'

class ArticleForm extends React.Component<{}, {title: string, content: string}> {
    constructor(props: any) {
        super(props);
        this.state = {
            title: '',
            content: ''
        };

    this.handleChangeTitle = this.handleChangeTitle.bind(this);
    this.handleChangeContent= this.handleChangeContent.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);

    }

    handleChangeTitle(event: any) {
        this.setState({title: event.target.value});
      }

    handleChangeContent(event: any) {
    this.setState({content: event.target.value});
    }
    
    handleSubmit(event: any) {
    console.log('Title: ' + this.state.title, 'Content: ' + this.state.content);
    event.preventDefault();
    const newPost = {
        title: this.state.title,
        content: this.state.content
        }
    }

    render() {
        return (
            <form style={{maxWidth: "18rem"}} onSubmit={this.handleSubmit} >
                <div className="card bg-light mb-3">
                    <div className="card-header" style={{color: "black"}}>
                    <div className="form-group">
                        <label style={{paddingRight: "1rem"}}>Title</label>
                        <input onChange={this.handleChangeTitle} type="text" className="form-controle" placeholder="Write your title here..."></input>
                    </div>
                </div>
                <div className="card-body">
                <div className="form-group">
                    <label>Content</label>
                    <textarea value={this.state.content} onChange={this.handleChangeContent} style={{resize: "none"}} className="form-control" id="exampleFormControlTextarea1" rows={3} placeholder="Write your post here..."></textarea>
                </div>
                    <button type={"submit"} className="btn btn-primary">Post</button>
                </div>
                </div>
            </form>
        )
    }
}

export default ArticleForm
