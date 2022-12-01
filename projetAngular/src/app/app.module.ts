import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { FormulinscriptionComponent } from './formulinscription/formulinscription.component'; //importation component creer

@NgModule({
  declarations: [
    AppComponent,
    FormulinscriptionComponent //c'est la declaration
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
