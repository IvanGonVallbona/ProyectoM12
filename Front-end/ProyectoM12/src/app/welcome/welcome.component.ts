import { Component } from '@angular/core';

@Component({
  selector: 'app-welcome',
  standalone: false,
  templateUrl: './welcome.component.html',
  styleUrl: './welcome.component.css'
})
export class WelcomeComponent {
  titol: string = "Des d'aquí pots triar entre diverses opcions, com ara unir-te a una campanya, visualitzar els teus personatges, veure els esdeveniments i notícies actuals i consultar els manuals d'alguns jocs que es juguen aquí.";
}
