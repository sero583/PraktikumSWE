import React from 'react';

import SyntaxHighlighter from 'react-syntax-highlighter';
import { docco } from 'react-syntax-highlighter/dist/esm/styles/hljs';

export default class PythonHighlighter extends React.Component {    
    constructor(props) {
        super(props);

        console.log(props.code);
    }

    render() {
        return(
            <SyntaxHighlighter language="python" style={docco}>{this.props.code}</SyntaxHighlighter>
        )
    }
}