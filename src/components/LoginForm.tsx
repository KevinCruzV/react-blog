
import { useState } from "react"

// Interface pour rentrer le state location du parent en tant que props
interface FormPropsInterface{
    setUsername: React.Dispatch<any>
    setPass: React.Dispatch<any>
}

//Composant pour le formulaire 
export default function LoginForm({setUsername, setPass} : FormPropsInterface){
    const [formInput1, setFormInput1] = useState<string>('')
    const [formInput2, setFormInput2] = useState<string>('')


    // 
    const handleChange1 = (e:any) => {
        const {value} = e.target;
        setFormInput1(value);
        console.log(value);
    }


    const handleChange2 = (e:any) => {
        const {value} = e.target;
        setFormInput2(value);
        console.log(value);
    }

    const handleSubmit = (e:any) => {
    
        setUsername(formInput1);
        setPass(formInput2);
    }

    return(
        <form className="mx-auto" style={{maxWidth:"350px"}} onSubmit={handleSubmit}>
            <h1 className="text-center mb-3">Sign-in</h1>
            <label htmlFor="username">Username :</label>
            <input type="text" name="username" className="form-control" value={formInput1} onChange={handleChange1}/>
            <label htmlFor="password">Password :</label>
            <input type="password" name="pass" className="form-control"value={formInput2} onChange={handleChange2} />
            <button type="submit" className="btn btn-primary">Envoyer</button>
        </form>
    )
};