import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ClasseListComponent } from './classe-list/classe-list.component';
import { WelcomeComponent } from './welcome/welcome.component';
import { ManualListComponent } from './manual-list/manual-list.component';
import { RazaListComponent } from './raza-list/raza-list.component';
import { CampanyaListComponent } from './campanya-list/campanya-list.component';
import { PersonatgeListComponent } from './personatge-list/personatge-list.component';

const routes: Routes = [
  { path: 'welcome', component: WelcomeComponent },
  { path: 'classe-list', component: ClasseListComponent },
  { path: 'manual-list', component: ManualListComponent },
  { path: 'raza-list', component: RazaListComponent },
  { path: 'campanya-list', component: CampanyaListComponent },
  { path: 'personatge-list', component: PersonatgeListComponent },
  { path: '', redirectTo: 'welcome', pathMatch: 'full' },
  { path: '**', redirectTo: 'welcome', pathMatch: 'full' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
