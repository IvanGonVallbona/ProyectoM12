import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RegistreListComponent } from './registre-list.component';

describe('RegistreListComponent', () => {
  let component: RegistreListComponent;
  let fixture: ComponentFixture<RegistreListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [RegistreListComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(RegistreListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
