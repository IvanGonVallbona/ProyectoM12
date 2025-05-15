import { Component, OnInit } from '@angular/core';
import { IRegistre } from '../interfaces/iregistre';
import { DadesRegistresService } from '../services/dades-registres.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-registre-list',
  standalone: false,
  templateUrl: './registre-list.component.html',
  styleUrl: './registre-list.component.css'
})
export class RegistreListComponent implements OnInit {
  titolLlistat = "Llistat de registres";
  registres: IRegistre[] = [];
  errorMessage: string = '';

  constructor(
    private registreService: DadesRegistresService,
    private route: ActivatedRoute
  ) { }

  ngOnInit() {
    const campanyaId = this.route.snapshot.paramMap.get('id');
    if (campanyaId) {
      this.registreService.getRegistresByCampanya(campanyaId).subscribe(registres => {
        this.registres = registres ?? [];
      });
    } else {
      this.registreService.indexRegistre().subscribe(registres => {
        this.registres = registres ?? [];
      });
    }
  }
}
