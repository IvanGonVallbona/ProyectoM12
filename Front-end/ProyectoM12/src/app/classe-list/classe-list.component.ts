import { Component } from '@angular/core';
import { OnInit } from '@angular/core';
import { HttpErrorResponse } from '@angular/common/http';
import { IClasse } from '../interfaces/iclasse';
import { DadesClassesService } from '../services/dades-classes.service';

@Component({
  selector: 'app-classe-list',
  standalone: false,
  templateUrl: './classe-list.component.html',
  styleUrl: './classe-list.component.css'
})
export class ClasseListComponent implements OnInit {
  titolLlistat = "Llistat de classes";
  classes: IClasse[] = [];
  listFilter: string = '';
  errorMessage: string = '';

  constructor(private classeService: DadesClassesService) { }

  ngOnInit() {
    console.log("Listat de classes inicialitzat");
    this.classeService.listClasses().subscribe(resp => {
      if (resp.body) {
        this.classes = resp.body;
      } else {
        console.error("No hay resultados");
      }
    });
  }

  eliminarClasse(id: any): void {
    this.classeService.deleteClasse(id).subscribe({
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
