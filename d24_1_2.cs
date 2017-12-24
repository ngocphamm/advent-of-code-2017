void Main()
{
	var _bridges = new List<Bridge>();
	var comps = new List<Component>();

    string line;
    using (var reader = File.OpenText(@"D:\Coding\Projects\TestCode\TestCode\Input\input_d24.txt"))
    {
        while((line = reader.ReadLine()) != null)
        {
            comps.Add(new Component
            {
                Ports = line.Split('/')
            });
        }
    }

    // Start with those components with 0 as start port
    foreach (var comp0 in comps.Where(c => c.Ports.Contains("0")))
    {
        var bridge = new Bridge { Comps = new List<Component> { comp0 } };

        foreach (var p in comp0.Ports)
        {
            if (p != "0") bridge.NextPort = p;
        }

        BuildBridge(comps, bridge, comp0, ref _bridges);
    }

    Console.WriteLine(_bridges.Count());
    Console.WriteLine(_bridges.Max(b => b.Strength));
	Console.WriteLine(_bridges.OrderByDescending(b => b.Comps.Count).ThenByDescending(c => c.Strength).First().Strength);
}

internal bool BuildBridge(List<Component> comps, Bridge bridge, Component cur, ref List<Bridge> _bridges)
{
    // Look for components with at least one port same as the free port in the current component
    var nextComps = comps.Where(c =>
        !bridge.Comps.Contains(c) &&
        c.Ports.Contains(bridge.NextPort)
    );

    if (nextComps.Count() == 0)
    {
        // No thing more to build. The bridge is finished and should be add to master list
        _bridges.Add(bridge);
        return false;
    }

    foreach (var nextComp in nextComps)
    {
        var newBridge = bridge.Clone();

        bool more = true;

        while (more)
        {
            foreach (var p in nextComp.Ports)
            {
                if (p != newBridge.NextPort)
                {
                    newBridge.NextPort = p;
                    break;
                }
            }

            newBridge.Comps.Add(nextComp);

            more = BuildBridge(comps, newBridge, nextComp, ref _bridges);
        }
    }

    return false;
}

internal class Bridge
{
    internal List<Component> Comps { get; set; }
    internal string NextPort { get; set; }

    internal int Strength
    {
        get
        {
            var sum = 0;
            foreach (var comp in Comps)
            {
                foreach (var port in comp.Ports)
                {
                    sum += int.Parse(port);
                }
            }

            return sum;
        }
    }

    public Bridge Clone()
    {
        var b = new Bridge();

        b.Comps = new List<Component>();
        b.Comps.AddRange(Comps);
        b.NextPort = NextPort;

        return b;
    }
}

internal class Component
{
    internal string[] Ports { get; set; }
}

internal class Port
{
    internal string Num { get; set; }
    internal bool Connected { get; set; }
}