import { Component } from '@angular/core';
import { OnInit } from '@angular/core';
import { HttpErrorResponse } from '@angular/common/http';
import { ICampanya } from '../interfaces/icampanya';
import { DadesCampanyesService } from '../services/dades-campanyes.service';

@Component({
  selector: 'app-campanya-list',
  standalone: false,
  templateUrl: './campanya-list.component.html',
  styleUrl: './campanya-list.component.css'
})
export class CampanyaListComponent implements OnInit {
  titolLlistat = "Llistat de campanyes";
  campanyes: ICampanya[] = [];
  listFilter: string = '';
  errorMessage: string = '';

  constructor(private campanyaService: DadesCampanyesService) { }

  ngOnInit() {
    console.log("Listat de classes inicialitzat");
    this.campanyaService.listCampanyes().subscribe(resp => {
      if (resp.body) {
        this.campanyes = resp.body;
      } else {
        console.error("No hay resultados");
      }
    });
  }
}
