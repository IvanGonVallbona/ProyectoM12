import { Component } from '@angular/core';
import { OnInit } from '@angular/core';
import { HttpErrorResponse } from '@angular/common/http';
import { IManual } from '../interfaces/imanual';
import { DadesManualsService } from '../services/dades-manuals.service';

@Component({
  selector: 'app-manual-list',
  standalone: false,
  templateUrl: './manual-list.component.html',
  styleUrl: './manual-list.component.css'
})
export class ManualListComponent implements OnInit {
  titolLlistat = "Llistat de manuals";
  manuals: IManual[] = [];
  listFilter: string = '';
  errorMessage: string = '';

  constructor(private manualService: DadesManualsService) { }

  ngOnInit() {
    console.log("Listat de manuals inicialitzat");
    this.manualService.listManuals().subscribe(resp => {
      if (resp.body) {
        this.manuals = resp.body;
      } else {
        console.error("No hay resultados");
      }
    });
  }

  eliminarManual(id: any): void {
    this.manualService.deleteManual(id).subscribe({
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
