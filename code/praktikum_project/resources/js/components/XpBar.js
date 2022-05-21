import '../../css/components/XpBar.css';
import React from "react";
export default function XpBar() {
    return (
        <div className="xpdiv">
            <br></br>
            <label for="progressBar">Account progress</label>
            <br></br>
            <br></br>
            <progress id="progressBar" max="100" value="30"></progress>
        </div>
        
    );
  }