import { Component } from '@angular/core';
import { OnInit } from '@angular/core';
import { HttpErrorResponse } from '@angular/common/http';
import { IRaza } from '../interfaces/iraza';
import { DadesRazasService } from '../services/dades-razas.service';

@Component({
  selector: 'app-raza-list',
  standalone: false,
  templateUrl: './raza-list.component.html',
  styleUrl: './raza-list.component.css'
})
export class RazaListComponent implements OnInit {
  titolLlistat = "Llistat de races";
  races: IRaza[] = [];
  listFilter: string = '';
  errorMessage: string = '';

  constructor(private razaService: DadesRazasService) { }

  ngOnInit() {
    console.log("Listat de races inicialitzat");
    this.razaService.indexRaza().subscribe(resp => {
      if (resp.body) {
        this.races = resp.body;
      } else {
        console.error("No hay resultados");
      }
    });
  }

  eliminarRaza(id: any): void {
    this.razaService.destroyRaza(id).subscribe({
      next: () => {
        this.ngOnInit();
      },
      error: (error: HttpErrorResponse) => {
        this.errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
        console.error('Error en eliminar', error);
      }
    });
  }
}
