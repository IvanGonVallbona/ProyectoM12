import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RazaListComponent } from './raza-list.component';

describe('RazaListComponent', () => {
  let component: RazaListComponent;
  let fixture: ComponentFixture<RazaListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [RazaListComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(RazaListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
