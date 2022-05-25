/// <reference types="cypress" />

describe('The home page', () => {
  beforeEach(() => {
    // We'll do a "php artisan migrate:fresh" before each test
    // so we don't get state from one test leaking into another
    cy.refreshDatabase()
  })

  it('shows a documentation section', () => {
    cy.visit('http://localhost').contains('Documentation')
  })
})
