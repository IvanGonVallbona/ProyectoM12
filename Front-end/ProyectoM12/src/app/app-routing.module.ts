import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ClasseListComponent } from './classe-list/classe-list.component';
import { WelcomeComponent } from './welcome/welcome.component';
import { ManualListComponent } from './manual-list/manual-list.component';

const routes: Routes = [
  { path: 'welcome', component: WelcomeComponent },
  { path: 'classe-list', component: ClasseListComponent },
  { path: 'manual-list', component: ManualListComponent },
  { path: '', redirectTo: 'welcome', pathMatch: 'full' },
  { path: '**', redirectTo: 'welcome', pathMatch: 'full' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
