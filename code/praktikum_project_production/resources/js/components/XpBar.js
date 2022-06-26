import '../../css/components/XpBar.css';
import React from "react";

export default function XpBar() {
    return (
        <div className="xpdiv">
            <label htmlFor="progressBar">Account progress</label>
            <br/>
            <progress id="progressBar" max="100" value="30">30%</progress>
        </div>
    );
  }