import { Component, OnInit } from '@angular/core';
import { IPersonatge } from '../interfaces/ipersonatge';
import { DadesPersonatgesService } from '../services/dades-personatges.service';
import { DadesClassesService } from '../services/dades-classes.service';
import { DadesRazasService } from '../services/dades-razas.service';
import { DadesManualsService } from '../services/dades-manuals.service';
import { DadesCampanyesService } from '../services/dades-campanyes.service';

@Component({
  selector: 'app-personatge-list',
  standalone: false,
  templateUrl: './personatge-list.component.html',
  styleUrls: ['./personatge-list.component.css']
})
export class PersonatgeListComponent implements OnInit {
  titolLlistat = "Llistat de personatges";
  personatges: IPersonatge[] = [];
  errorMessage: string = '';

  constructor(
    private personatgeService: DadesPersonatgesService,
    private classeService: DadesClassesService,
    private razaService: DadesRazasService,
    private manualService: DadesManualsService,
    private campanyaService: DadesCampanyesService,
  ) { }

  ngOnInit(): void {
    console.log("Listat de manuals inicialitzat");
    this.personatgeService.listPersonatges().subscribe(resp => {
      if (resp.body) {
        this.personatges = resp.body;
        this.loadRelatedData();
      } else {
        console.error("No hay resultados");
      }
    });
  }

  loadRelatedData() {
    this.personatges.forEach(personatge => {
      // Clase
      if (personatge.classe_id && typeof personatge.classe_id === 'number') {
        this.classeService.getClasse(personatge.classe_id).subscribe(res => {
          personatge.classe_id = res.body;
        });
      }
      // Raza
      if (personatge.raza_id && typeof personatge.raza_id === 'number') {
        this.razaService.getRaza(personatge.raza_id).subscribe(res => {
          personatge.raza_id = res.body;
        });
      }
      // Manual/Joc
      if (personatge.joc_id && typeof personatge.joc_id === 'number') {
        this.manualService.getManual(personatge.joc_id).subscribe(res => {
          personatge.joc_id = res.body;
        });
      }
      // Campanya
      if (personatge.campanya_id && typeof personatge.campanya_id === 'number') {
        this.campanyaService.getCampanya(personatge.campanya_id).subscribe(res => {
          personatge.campanya_id = res.body;
        });
      }
    });
  }

  getNom(obj: any): string {
    return (obj && typeof obj === 'object' && 'nom' in obj) ? obj.nom : '';
  }
}
