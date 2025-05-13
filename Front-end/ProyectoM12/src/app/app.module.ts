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
import { ClasseCreateComponent } from './classe-create/classe-create.component';
import { ClasseEditComponent } from './classe-edit/classe-edit.component';
import { ManualListComponent } from './manual-list/manual-list.component';
import { RazaListComponent } from './raza-list/raza-list.component';


@NgModule({
  declarations: [
    AppComponent,
    NavBarComponent,
    ClasseListComponent,
    WelcomeComponent,
    ClasseCreateComponent,
    ClasseEditComponent,
    ManualListComponent,
    RazaListComponent,
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
