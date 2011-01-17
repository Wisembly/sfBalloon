Utilisation
===========

Dans le schema.yml, dans la table qui réagit (exemple, Wall pour avoir un wall_count dans Event)

    Wall:
      actAs:
        CountCache:
          relations:
            Event:
              columnName: wall_count
              foreignAlias: Walls
              
Ajouter la column dans Event (pour pouvoir faire getWallCount())

    Event:
      actAs:
        Timestampable: ~
        SoftDelete: ~
      columns:
        # ...
        wall_count:         { type: integer, default: 0 }

Build la database

Et c'est finit !