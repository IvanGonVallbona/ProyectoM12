import { NgModule } from '@angular/core';
import { BrowserModule, provideClientHydration, withEventReplay } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavBarComponent } from './nav-bar/nav-bar.component';
import { ClasseListComponent } from './classe-list/classe-list.component';
import { WelcomeComponent } from './welcome/welcome.component';
import { ReactiveFormsModule } from '@angular/forms';
import { FormsModule } from "@angular/forms";
import { provideHttpClient } from '@angular/common/http';
import { ManualListComponent } from './manual-list/manual-list.component';
import { RazaListComponent } from './raza-list/raza-list.component';
import { CampanyaListComponent } from './campanya-list/campanya-list.component';
import { PersonatgeListComponent } from './personatge-list/personatge-list.component';
import { RegistreListComponent } from './registre-list/registre-list.component';


@NgModule({
  declarations: [
    AppComponent,
    NavBarComponent,
    ClasseListComponent,
    WelcomeComponent,
    ManualListComponent,
    RazaListComponent,
    CampanyaListComponent,
    PersonatgeListComponent,
    RegistreListComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    AppRoutingModule
  ],
  providers: [
    provideClientHydration(withEventReplay()),
    provideHttpClient()
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
