import { TestBed } from '@angular/core/testing';

import { DadesManualsService } from './dades-manuals.service';

describe('DadesManualsService', () => {
  let service: DadesManualsService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(DadesManualsService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
