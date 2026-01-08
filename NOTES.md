# Dev Notes

## 2026-01-07

Added DSS (decision support) features for reordering. Using EOQ formula from that operations management class lol. The formula is:

```
EOQ = sqrt((2 * D * S) / H)
```

where D = annual demand, S = ordering cost, H = holding cost per unit

Currently hardcoding $50 for ordering cost - should make this configurable.

## 2026-01-05

Basic CRUD done. Need to add:
- auth (probably use Breeze, Jetstream is overkill for this)  
- the low stock alert email thing boss asked about
- csv export for the accountant

## Known bugs

- If a product has no transactions, the consumption chart just shows zeros. Should probably show a "no data" message instead.
- Deleting a category with products in it will cause foreign key issues. Need to either prevent deletion or cascade.

## Random notes

- Supplier reliability score is stored as 0.00-1.00 not percentage. Remember to multiply by 100 for display
- Price is in IDR (rupiah) so no decimals needed for display but keeping decimal type in DB just in case
- The priority scoring weights are kinda arbitrary. Might need to tune based on actual usage patterns
