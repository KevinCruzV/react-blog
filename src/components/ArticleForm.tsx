
import React, {useState} from "react";


export default function Form() {



    const [title, setTitle] = useState<string>('');
    const [content, setContent] = useState<string>('');


    const TitleChange = (e:any) => {
        console.log(e.target.value)
        setTitle(e.target.value);
    };


    const ContentChange = (e:any) => {
        console.log(e.target.value)
        setContent(e.target.value);
    };

    const HandleSubmit = (e:any) => {
        console.log('Title: ' + title, 'Content: ' + content);
        
        let newPost = {
            title: title,
            content: content
            }

        let data = JSON.stringify(newPost);
    
        const headers = new Headers({
            'Content-type': 'application/x-www-form-urlencoded'
        });
    
        const requestOptions = {
            headers: headers,
            method: "POST",
            body: data,
        };
    
        fetch('http://localhost:2345/src/Controllers/CreatePostController.php', requestOptions)
        .then(response => console.log(response.status))
        
    }
    


    return (
        <form style={{maxWidth: "18rem"}} onSubmit={HandleSubmit} >
            <div className="card bg-light mb-3">
                <div className="card-header" style={{color: "black"}}>
                    <div className="form-group">
                        <label style={{paddingRight: "1rem"}}>Title</label>
                        <input onChange={TitleChange} type="text" className="form-controle" placeholder="Write your title here..."></input>
                    </div>
                </div>
                <div className="card-body">
                    <div className="form-group">
                        <label>Content</label>
                        <textarea value={content} onChange={ContentChange} style={{resize: "none"}} className="form-control" id="exampleFormControlTextarea1" rows={3} placeholder="Write your post here..."></textarea>
                    </div>
                    <button type="submit" className="btn btn-primary">Post</button>
                </div>
            </div>
        </form>
    )
}
