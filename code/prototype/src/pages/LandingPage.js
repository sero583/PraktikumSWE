import Register from './Register';

export default function Home(){
    return (
        <div className='home'>
            <div className='innerHome'>
                <h1>Code Academy</h1>
                <p>Code Academy wants to offer an easy way to learn the most commonly used programming languages. Our lessons are easy to follow and thanks to our built-in compiler and runtime you don't have to waste any time setting up an environment. Have fun coding!</p>
                <Register />
            </div>
        </div>
    );
}