import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HasManyCascadeComponent } from './has-many-cascade.component';

describe('HasManyCascadeComponent', () => {
  let component: HasManyCascadeComponent;
  let fixture: ComponentFixture<HasManyCascadeComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ HasManyCascadeComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(HasManyCascadeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
