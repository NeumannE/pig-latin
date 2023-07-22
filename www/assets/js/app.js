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