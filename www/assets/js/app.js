/** import jquery **/
import $ from "jquery";

/** import and initial naja and nette forms **/
import naja from 'naja';
import netteForms from 'nette-forms';

window.Nette = netteForms;

document.addEventListener('DOMContentLoaded', naja.initialize.bind(naja));
netteForms.initOnLoad();


/** import main css file **/
import '../scss/main.scss'

/** import bootstrap **/
import * as bootstrap from 'bootstrap';

function init_resizable_textarea(){
    $("textarea").each(function () {
        this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;resize:none;");
    }).on("input", function () {
        this.style.height = 0;
        this.style.height = (this.scrollHeight) + "px";
    });
}

naja.snippetHandler.addEventListener('afterUpdate', (event) => {
    init_resizable_textarea();
});

init_resizable_textarea();